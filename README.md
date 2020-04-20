# Task Sample Implementation

A sample implementation of a task/challenge set, for reference by the team.

## Requirements

* Create a /breweries endpoint which calls the https://api.openbrewerydb.org/breweries endpoint
* You should take the API response that is returned and transform it to a different response. Your response should nest the address data into a separate structure
* You should expose a URL in each individual record/resource which points to the second endpoint (see below) in your API.
* Create a /breweries/{brewery} endpoint which calls the appropriate API on the openbrewerydb API. Once again, you should transform the response to nest the address in a seperate structure
* Use Guzzle to make your API calls
* Guzzle, or a wrapper around it, should be injected into your controller

### Bonus points

If you find you have completed the task, and still have some time available, consider the following optional requirements (if you don’t have time to implement, you are welcome to share a sentence or two about your thoughts about how you might do this)

* Create a simple API client class which uses Guzzle, and inject this instead of Guzzle into your controller
* We haven’t considered pagination, however the /breweries endpoint supports pagination. Can you leverage Laravels built in pagination support somehow, and map this to the underlying API which is being called?
* Could you use a package such as https://github.com/jenssegers/model (eloquent-style models without DB integration) to serve as models for the API response data?
* If you are able to use that model package, can you hook it into the route model binding process?
