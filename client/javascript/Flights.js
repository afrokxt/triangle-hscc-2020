
const apiKey = 'tri9247b-4926-4145-93de-85c500480c93';

let url = `https://airports.api.hscc.bdpa.org/v2/flights?match=${}`;
let allFlightsRequest = new XMLHttpRequest();

allFlightsRequest.open("GET", url);
allFlightsRequest.setRequestHeader("key", apiKey);
allFlightsRequest.setRequestHeader("content-type", "application/json");
const populateFlightsList = function () {
  let flightsObj = JSON.parse(allFlightsRequest.responseText);
  console.log(flightsObj);
};
allFlightsRequest.onreadystatechange = function () {
  if (this.readyState === 4) {
    switch (this.status) {
      case 200:
      default:
        populateFlightsList();

        break;
      case 400:
        //error 400: request malformed
        break;
      case 401:
        //error 401: Session not authenticated
        break;
      case 403:
        //error 403: unauthorized action
        break;
      case 404:
        //error 404: endpoint not found
        break;
      case 405:
        //error 405: incorrect request method
        break;
      case 413:
        //error 413: request too large
        break;
      case 429:
        //error 429: youve been rate limited, wait 15 minutes and try again
        break;
      case 500:
        //do something
        break;
    }
  }
};

allFlightsRequest.send();
