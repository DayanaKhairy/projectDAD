The total applications involved are 3.
1- certiment browser application a website to upload documents such as files and certificates for civil workers to keep track of their publications or awards. this system can view the documents uploaded and craete its own portfolio
2- retrieve swing application, based on the documents uploaded the user currently using the application will be able to retrieve the documents data from the certiment application and search for specific document names. 
 they will then be able to save the document data they have searched via socket to a another appication
3- show sqing application that will get the data submitted from the retrieve swing application and calculate the total of files that have been searched. 

Architechture Layer Diagram 

List of URL endpoints for middleware socket 
- String url = "jdbc:mysql://localhost:3306/certimentdb";
- Socket socket = new Socket("192.168.1.131", 65432)
- String filePath = "C:/Users/Acer/OneDrive/Documents/UTeM/DADA/documents1.txt";
- http://localhost/certiment2.0/certiment2.0/document.php

Functions and features of the middleware 
1. the middleware creates a socket port to transfer the data submitted to another ip address that holds the database server.
2. the middleware server socket opens the port and starts listening to any client that has connected to the server port.
3. the socket provides one port that is specified in the java code.
4. ensures safety and privacy by only using a specific ip address and port listening number.

The database is certimentdb involves
-2 main tables Documents and Searched Documents. 
-Other tables used for the certiment application.
