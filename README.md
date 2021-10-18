# incentive-system
# OVIA INCENTIVES PROGRAM
High level Design Document

### Overview:
Ovia needs to build an incentive system that rewards user engagement. Employers can choose from an available list of incentive programs offered by Ovia. 

Assumptions:
1.	Ovia app uses PHP 7.1 and newer
2.	Ovia app supports Laravel
3.	Ovia system will be accessed using REST APIs

High Level Design
1.	Ovia has an endpoint to interact with the incentives system.
2.	REST API endpoints to read all available incentive events/programs
3.	REST API to GET employer specific incentive events
4.	REST API to GET, POST, PUT, DELETE user data to individual Ovia incentive events

OviaGlobalIncentivesController
This will be called for the REST API endpoints that are looking to interface with the Ovia Incentives System. Some examples are:
1.	Get all available incentive events
2.	Get employer specific incentive events (Used by employer’s admin)
3.	Get user specific incentive events ( what the end use would see from the employers site)

Design for the Incentive Events

Proposed design to implement various incentive events: Strategy pattern, where we define a family of algorithms , encapsulate each one and make them interchangeable. Strategy lets the algorithm vary independently from clients that use it.

![image1](https://github.com/narmada-komarasamy/incentive-system/blob/master/img1.jpg)
 

Binding of necessary event module will be done in AppServiceProvider. We can use contextual binding to read the request and bind the module based on the request. Example, request could contain the event id and we bind the necessary event based on that id. This way we can add/delete events as needed without disrupting the user experience and with minimum API calls for the client.

Design for identifying when an user reaches reward incentive
•	Use Observer design pattern, to listen to changes in state for an event model and notify the notificationInterface. 
•	Use Laravel Model Observers. Eloquent provides a handful of useful events to monitor the model state, such as, created , saved, updated, etc
•	When the state changes to created, it means a new user data has been created. Perform the event specific logic here. Ex: birth date added for Event1 or checking if n times of data have been added for Event2
•	The Observer can in turn call a global notification interface and inject the event in the constructor, or can directly call the event specific notification class.
•	Third party apps can in turn be called from these notification classes. Or the Observer can be used to call multiple notification modules as needed. 
 

