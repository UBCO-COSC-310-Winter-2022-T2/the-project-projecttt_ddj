# FINAL DOCUMENTATION


-	What did your team build? Is it feature complete and running?

This website is designed to implement a classroom polling system. It consists of two main components: the iclicker software that is run by the instructor and the iclicker mobile and devices to interact with the instructor. This clicker system enables the instructor to release multiple-choice and short-answer questions and student can submit their answers using their devices which are transmitted to the software. The instructor can grade the results in real time and display them on the devices used by students. The iClicker system also allows the instructor to keep a track of attendance.
To conclude , this website allows for real-time interaction between the student and the instructor which results in interactive discussions and participation.

-	How many of your initial requirements that your team set out to deliver did you deliver (a checklist/table would help to summarize)?
Requirements delivered:
1.	Made a dashboard for the student 
2.	Made a dashboard for the instructor
3.	Login/Create an account page for the student 
4.	Login/Create an account page for the instructor
5.	Student (after logging in) can view their courses
6.	Students can join their courses, and look at their attendance and statistics (performance in the class)
7.	Instructors (after logging in) can view their courses.
8.	Instructors can add new courses
9.	Instructors (after logging in) can start the class




       -  Were you able to deliver everything or are there things missing?

Incomplete feature- Instructors can grade the results, this is one of the features in terms of the instructor that was not completed due to time constraint. it required the implementation of some advanced coding functions and due to the limited time frame and other prior commitments, we faced issues as a team completing this feature with full efficiency.


-	 Did your initial requirements sufficiently capture the details needed for the project?
The initial requirements which were specified by us as a team sufficiently captured the details needed for the project. The requirements specified by us contained functional and non-functional requirements, user requirements and system requirements. The initial requirements specified all the necessary implementations for the system to be running efficiently. 




-	What is the architecture of the system?
I follows a client-server architecture where the client keeps sending a request to the server to get any information. The client send the request to the server using their system and the server responds to the request with the required information. There can be other architectures used for the same as well.



-	What are the key components?
The main key components of a polling system are as follows: client application to send requests to the server for retrieving the required information, server application to send the information to the client, database to store the data needed and the communication protocol to figure out about the communication between the client and the server.




-	 What design patterns did you use in the implementation?

There are various design patterns used for the polling system such as the observer pattern where the clients act as an observer and registers with the server to receive updates and the singleton pattern where it es ensured that there is only one instance of the server application which will be running at any given time.




-	 How many tasks are left in the backlog?

There is just one task which is in backlog and that is to add the feature of grading the results by the instructor. This feature was in progress during milestone 4 but it required some advanced coding implementation for it to run efficiently.


