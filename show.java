package TryAgain;

import java.awt.EventQueue;
import javax.swing.JFrame;
import javax.swing.JLabel;
import java.awt.Font;
import javax.swing.JTextArea;
import javax.swing.JButton;
import javax.swing.JTextField;
import java.awt.event.ActionListener;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.awt.event.ActionEvent;
import javax.swing.JOptionPane;

public class show {

    private JFrame frame;
    private JTextArea textArea;
    private JTextField totalField;

    public static void main(String[] args) {
        // Start the server in a new thread
        new Thread(() -> startServer()).start();

        // Start the Swing application
        EventQueue.invokeLater(() -> {
            try {
                show window = new show();
                window.frame.setVisible(true);
            } catch (Exception e) {
                e.printStackTrace();
            }
        });
    }

    private static void startServer() {
        int port = 65432; // Port to listen on

        try (ServerSocket serverSocket = new ServerSocket(port)) {
            System.out.println("Server is listening on port " + port);

            while (true) {
                try (Socket socket = serverSocket.accept()) {
                    System.out.println("New client connected");

                    BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
                    String data = in.readLine();

                    String[] parts = data.split("\\|");
                    String documentName = parts[0];
                    String documentStatus = parts[1];
                    String userEmail = parts[2];

                    saveToDatabase(documentName, documentStatus, userEmail);
                    PrintWriter out = new PrintWriter(new OutputStreamWriter(socket.getOutputStream()), true);
                    out.println("Data saved successfully");
                }
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private static void saveToDatabase(String documentName, String documentStatus, String userEmail) {
        String url = "jdbc:mysql://localhost:3306/certimentdb";
        String username = "root";
        String password = "";

        String query = "INSERT INTO searched_documents (document_name, document_status, user_email) VALUES (?, ?, ?)";

        try (Connection connection = DriverManager.getConnection(url, username, password);
             PreparedStatement preparedStatement = connection.prepareStatement(query)) {

            preparedStatement.setString(1, documentName);
            preparedStatement.setString(2, documentStatus);
            preparedStatement.setString(3, userEmail);
            preparedStatement.executeUpdate();

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public show() {
        initialize();
    }

    private void initialize() {
        frame = new JFrame();
        frame.setBounds(100, 100, 639, 450);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.getContentPane().setLayout(null);

        JLabel lblNewLabel = new JLabel("Retrieved Documents");
        lblNewLabel.setFont(new Font("Tahoma", Font.PLAIN, 15));
        lblNewLabel.setBounds(20, 26, 160, 19);
        frame.getContentPane().add(lblNewLabel);

        textArea = new JTextArea();
        textArea.setBounds(20, 55, 348, 200);
        frame.getContentPane().add(textArea);

        JButton btnRetrieveData = new JButton("Retrieve Data");
        btnRetrieveData.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent e) {
                retrieveDataFromDatabase();
            }
        });
        btnRetrieveData.setFont(new Font("Tahoma", Font.PLAIN, 15));
        btnRetrieveData.setBounds(385, 81, 144, 34);
        frame.getContentPane().add(btnRetrieveData);

        JLabel lblTotalDocuments = new JLabel("Total Documents:");
        lblTotalDocuments.setFont(new Font("Tahoma", Font.PLAIN, 15));
        lblTotalDocuments.setBounds(20, 270, 120, 20);
        frame.getContentPane().add(lblTotalDocuments);

        totalField = new JTextField();
        totalField.setBounds(150, 270, 150, 25);
        totalField.setEditable(false);
        frame.getContentPane().add(totalField);
    }

    private void retrieveDataFromDatabase() {
        String url = "jdbc:mysql://localhost:3306/certimentdb";
        String username = "root";
        String password = "";
        String query = "SELECT document_name, document_status, user_email FROM searched_documents";

        try (Connection connection = DriverManager.getConnection(url, username, password);
             Statement statement = connection.createStatement();
             ResultSet resultSet = statement.executeQuery(query)) {

            StringBuilder sb = new StringBuilder();
            int totalCount = 0;

            while (resultSet.next()) {
                String documentName = resultSet.getString("document_name");
                String documentStatus = resultSet.getString("document_status");
                String userEmail = resultSet.getString("user_email");

                sb.append("Document Name: ").append(documentName)
                  .append(", Document Status: ").append(documentStatus)
                  .append(", User Email: ").append(userEmail)
                  .append("\n");

                totalCount++;
            }

            if (totalCount == 0) {
                JOptionPane.showMessageDialog(frame, "No data found!", "Info", JOptionPane.INFORMATION_MESSAGE);
            } else {
                textArea.setText(sb.toString());
                totalField.setText(String.valueOf(totalCount));
                JOptionPane.showMessageDialog(frame, "Data retrieved successfully!", "Success", JOptionPane.INFORMATION_MESSAGE);
            }

        } catch (Exception e) {
            e.printStackTrace();
            JOptionPane.showMessageDialog(frame, "Error retrieving data!", "Error", JOptionPane.ERROR_MESSAGE);
        }
    }
}
