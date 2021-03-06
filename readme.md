 
### Installation 

#### Prepare Project
 clone this repository and go to root of the project and run the below commands : 
 
* composer install 
* composer dump-autoload -o 
* php artisan key:generate

#### seed database 
in the root of the projects run below commands ( please make sure you configure your data base in .env file )
* php artisan migrate
* php artisan db:seed
> by running the above commands data (messages_sample.json) will be inserted in the database and a user will be created for using the api

 #### Authentication
 This project uses Basic Authentication, it means there is no saved sessions, and all requests should contains username and password
 
#### run the project
you can go to root of the project and use the command : **php artisan serv**
(note : you may create any virtual host also)


#### project structure 
```text
You can find all the codes inside the directory : app/mailBox
```

inside the app/mailBox you can find these files and folders :

* **Controllers** // the controller which is used by api
* **Exceptions** // exceptions which will be handled by api
* **Model** // database model
* **Response** // classes which are responsible to generate output based on different strategies
* **Services** // message abstraction and it's services
---- 
#### Approach
the approach of creating the api can be summarized as below
##### **Domain** 
in this project there is only one domain, and it is **message**

##### **Design**
based on the senario design of api can be break down to below parts 
* **Base Url**  
the base url should be very simple and intuitive, so it just contains domain (**message**) and version (in this case **v1**).

* **Pagination, Filtering** as a best practice pagination and filtering was included in url
* **versioning** : the version attached to base url
* **Error Codes** two types of error code implemented 
 - Http response code 
 - Application response code
* **HATEOAS** : any GET response contains a unique url to that resourse
* **Response Format** : as a standard response, I followed up the [jsonapi.com](http://jsonapi.com) as data model (also for error and meta block)

| Http Method   |  Request                                                       | Description                                  |
| ------------- |:--------------------------------------------------------------:| --------------------------------------------:|
| *GET*           | /api/v1/messages/{uid}                                       | get a message with specific uid|
| *GET*           | /api/v1/messages/                                            | get all messages               |
| *GET*           | /api/v1/messages/?offset={value}&&limit={value}&&status={status} | get messages with custom offset, limit and status (read, unread, archived) |
| *PUT*           | /api/v1/messages/{uid}/{new status}                           | update the status of custom email with uid identifier and new status (read, unread, archived) |

examples : 
 * PUT **/api/v1/messages/24/archived**  (this will update the status of a mesage with id 24)
 * GET **/api/messages/?offset=0&&limit=10&&status=read**    (this will get 10 first messages with status read )
 * GET **/api/v1/messages**  (get all messages)
 

#### Sample PostMan collection 
[postmanLinks](https://www.getpostman.com/collections/915609b8bd2d9f310de9)
