package TryAgain; 
 
import java.awt.EventQueue; 
import java.awt.event.ActionEvent; 
import java.awt.event.ActionListener; 
import java.io.BufferedReader; 
import java.io.FileReader; 
import java.io.IOException; 
//import java.io.InputStreamReader; 
import java.io.OutputStream; 
//import java.net.HttpURLConnection; 
import java.net.Socket; 
//import java.net.URL; 
//import java.net.URLEncoder; 
import java.nio.charset.StandardCharsets; 
 
import javax.swing.JFrame; 
import javax.swing.JTextField; 
import javax.swing.JTextArea; 
import javax.swing.JLabel; 
import javax.swing.JOptionPane; 
import javax.swing.JButton; 
import javax.swing.SwingUtilities; 
import javax.swing.SwingWorker; 
 
public class retrieve { 
 
    private JFrame frame; 
    private JTextField txtFldName; 
    private JTextField txtStatus; 
    private JTextField txtUserEmail; 
 
    public static void main(String[] args) { 
        EventQueue.invokeLater(new Runnable() { 
            public void run() { 
                try { 
                 retrieve window = new retrieve(); 
                    window.frame.setVisible(true); 
                } catch (Exception e) { 
                    e.printStackTrace(); 
                } 
            } 
        }); 
    } 
 
    public retrieve() { 
        initialize(); 
    } 
 
    private void initialize() { 
        frame = new JFrame(); 
        frame.setBounds(100, 100, 450, 300); 
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); 
        frame.getContentPane().setLayout(null); 
 
        txtFldName = new JTextField(); 
        txtFldName.setBounds(139, 178, 134, 20); 
        frame.getContentPane().add(txtFldName); 
        txtFldName.setColumns(10); 
 
        JTextArea textArea = new JTextArea(); 
        textArea.setBounds(35, 71, 374, 96); 
        frame.getContentPane().add(textArea); 
 
        JLabel lblNewLabel = new JLabel("Data From Text File"); 
        lblNewLabel.setBounds(35, 46, 161, 14); 
        frame.getContentPane().add(lblNewLabel); 
 
        JButton btnNewButton = new JButton("Load Data"); 
        btnNewButton.addActionListener(new ActionListener() { 
            public void actionPerformed(ActionEvent e) { 
                fetchDataFromFile(textArea); 
            } 
        }); 
        btnNewButton.setBounds(121, 11, 176, 23); 
        frame.getContentPane().add(btnNewButton); 
 
        JLabel lblNewLabel_1 = new JLabel("Document Name"); 
        lblNewLabel_1.setBounds(35, 181, 94, 14); 
        frame.getContentPane().add(lblNewLabel_1); 
 
        JLabel lblNewLabel_2 = new JLabel("Status"); 
        lblNewLabel_2.setBounds(35, 206, 78, 14); 
        frame.getContentPane().add(lblNewLabel_2); 
 
        txtStatus = new JTextField(); 
        txtStatus.setBounds(139, 203, 134, 20); 
        frame.getContentPane().add(txtStatus); 
        txtStatus.setColumns(10); 
 
        JLabel lblNewLabel_3 = new JLabel("User Email"); 
        lblNewLabel_3.setBounds(35, 231, 78, 14); 
        frame.getContentPane().add(lblNewLabel_3); 
 
        txtUserEmail = new JTextField(); 
        txtUserEmail.setBounds(139, 228, 134, 20); 
        frame.getContentPane().add(txtUserEmail); 
        txtUserEmail.setColumns(10); 
 
        JButton btnSC = new JButton("Search Document"); 
        btnSC.addActionListener(new ActionListener() { 
            public void actionPerformed(ActionEvent e) { 
                String documentName = txtFldName.getText(); 
                searchDocument(documentName, textArea); 
            } 
        }); 
        btnSC.setBounds(296, 177, 140, 23); 
        frame.getContentPane().add(btnSC); 
 
        JButton btnSTD = new JButton("Save To Database"); 
        btnSTD.addActionListener(new ActionListener() { 
            public void actionPerformed(ActionEvent e) { 
                String documentName = txtFldName.getText(); 
                String status = txtStatus.getText(); 
                String userEmail = txtUserEmail.getText(); 
                saveToDatabase(documentName, status, userEmail); 
            } 
        });
        btnSTD.setBounds(296, 227, 140, 23); 
        frame.getContentPane().add(btnSTD); 
    } 
 
    private void saveToDatabase(String documentName, String status, String userEmail) { 
        SwingWorker<Void, Void> worker = new SwingWorker<Void, Void>() { 
            @Override 
            protected Void doInBackground() throws Exception { 
                try (Socket socket = new Socket("192.168.1.131", 65432)) { 
                    OutputStream os = socket.getOutputStream(); 
                    String data = documentName + "|" + status + "|" + userEmail; 
                    os.write(data.getBytes(StandardCharsets.UTF_8)); 
                    os.flush(); 
                    JOptionPane.showMessageDialog(frame, "Data sent to server successfully.", "Success", JOptionPane.INFORMATION_MESSAGE); 
                } catch (IOException ex) { 
                    ex.printStackTrace(); 
                    JOptionPane.showMessageDialog(frame, "Error: " + ex.getMessage(), "Error", JOptionPane.ERROR_MESSAGE); 
                } 
                return null; 
            } 
        }; 
 
        worker.execute(); 
    } 
 
 
    private void searchDocument(String documentName, final JTextArea textArea) { 
        SwingWorker<Void, Void> worker = new SwingWorker<Void, Void>() { 
            @Override 
            protected Void doInBackground() throws Exception { 
                try { 
                    String filePath = "C:/Users/User/Downloads/documents1.txt"; 
                    try (BufferedReader br = new BufferedReader(new FileReader(filePath))) { 
                        String line; 
                        StringBuilder content = new StringBuilder(); 
                        boolean documentFound = false; 
 
                        while ((line = br.readLine()) != null) { 
                            String[] fields = line.split(",\\s*"); 
                            String name = ""; 
                            String status = ""; 
                            String email = ""; 
 
                            for (String field : fields) { 
                                String[] keyValue = field.split(":\\s*"); 
                                if (keyValue.length == 2) { 
                                    String key = keyValue[0].trim(); 
                                    String value = keyValue[1].trim(); 
 
                                    switch (key) { 
                                        case "Document Name": 
                                            name = value; 
                                            break; 
                                        case "Document Status": 
                                            status = value; 
                                            break; 
                                        case "User Email": 
                                            email = value; 
                                            break; 
                                    } 
                                } 
                            } 
 
                            if (documentName.trim().equalsIgnoreCase(name)) { 
                                final String finalName = name; 
                                final String finalStatus = status; 
                                final String finalEmail = email; 
 
                                SwingUtilities.invokeLater(() -> { 
                                    txtFldName.setText(finalName); 
                                    txtStatus.setText(finalStatus); 
                                    txtUserEmail.setText(finalEmail); 
                                }); 
                                documentFound = true; 
                                break; 
                            } 
 
                            content.append("Document Name: ").append(name) 
                                   .append(", Status: ").append(status) 
                                   .append(", User Email: ").append(email) 
                                   .append("\n"); 
                        }
                        if (!documentFound) { 
                            SwingUtilities.invokeLater(() -> { 
                                JOptionPane.showMessageDialog(frame, "Document not found", "Info", JOptionPane.INFORMATION_MESSAGE); 
                            }); 
                        } 
 
                        final String data = content.toString(); 
                        SwingUtilities.invokeLater(() -> { 
                            textArea.setText(data); 
                        }); 
                    } 
                } catch (IOException e) { 
                    e.printStackTrace(); 
                } 
                return null; 
            } 
        }; 
 
        worker.execute(); 
    } 
 
 
    private void fetchDataFromFile(final JTextArea textArea) { 
        SwingWorker<Void, Void> worker = new SwingWorker<Void, Void>() { 
            @Override 
            protected Void doInBackground() throws Exception { 
              String filePath = "C:/Users/User/Downloads/documents1.txt"; 
 
                 try (BufferedReader br = new BufferedReader(new FileReader(filePath))) { 
                     StringBuilder sb = new StringBuilder(); 
                     String line; 
 
                     while ((line = br.readLine()) != null) { 
                         sb.append(line).append("\n"); 
                     } 
 
                     textArea.setText(sb.toString()); 
 
                 } catch (IOException e) { 
                     e.printStackTrace(); 
                 } 
    return null; 
             } 
        }; 
 
        worker.execute(); 
    } 
}