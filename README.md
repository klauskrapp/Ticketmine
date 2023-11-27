


# About Ticketmine
<p>
Version: 0.0.1
</p>
Ticketmine is based on the laravel Framework and requires PHP8.1 and a MySQL Database.

Ticketmine is designed for internal usage, and comes with a lot features e.g.

- Define Projects
- Create Users
- Create priorities, actiontypes or states
- Create tickets for specific projects with priorities, actiontypes, states, assigneed or follower
- Add attachments to tickets
- Leave comments in tickets
- Add custom attributes to tickets
- Receive notification emails, when editing a ticket
- Choose between user and admin
- german and englisch language support
- configure custom dashboards for each user

## Admin features

### Projects
You can create mutliple projects, where tickets are assigned to. 
You can also define, which project is visibile to the users

### Priorities
Create priorities (e.g. high, low, medium ) and assign them to a project.
You can create custom priorities for each project. 

### Actiontypes
Create actiontypes (e.g. bug, new feature) and assign them to a project.
You can create custom actiontypes for each project. 


### States
Create states (e.g.open, in progress finished ) and assign them to a project.
You can create custom states for each project.
After creating some states, you have to define a state-chain.
A state-chain defines, from which state a tickets state can switch into. 
e.g.  open -> in progress and from in progress -> closed


### Attributes
define custom attributes and assign them to multiple projects.
with attributes, you can add individualized fields to tickets


### Users
add new users to ticketmine and define, which projects they're assigned to

## global features

### Search, Filter
each user can use the filterform to find some tickets. After executing a filter, 
the user can save the filterform and create dashboard elements out of his own filters.
e.g. create a dashboard with tickets assigned to me with the state = open


### Dashboard
each user can define multiple dashboards and several dashboardelements to it.
a dashboardelement can be a grid, that consumes a filter for its data or 
an activitystream, that shows all changes to done to the tickets.

### Profile
every user can change his own profile. e.g uploading an avatar oder changing his name
or password. You can also define the receiving of ticketmine emails

### Creating a Ticket
every user can create tickets, according the projects he/she is assigned to. 
When creating new tickets, you have to choose the project, the ticket is created
into. After that, you can set the priority, state, attributes or actiontypes the
tickets project is assigned to.

### Editing a Ticket
When editing a ticket, you can leave new comments (also mention user or refer to tickets) or
add attachments.
you can change followers, assignees or the author of ticket. Change priority, state or attributes.





### Installation







