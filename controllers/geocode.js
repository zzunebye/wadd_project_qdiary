//  call geocode()
//  geocode();

// Get Location form

const locationForm = document.getElementById('location-form');

// Listen for Submit

let map = '';

function geocodeDefault(location) {
  // Prevent actual submit

  // const location = 'busan'
  // const location = "<?php echo $_SESSION['cur_locale'];?>";

  console.log("adsf:  ", location);
  axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
      params: {
        address: location,
        key: 'AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI'
      }
    })
    .then(function (response) {
      // Log full response
      console.log(response);

      //Formatted Address
      let formattedAddress = response.data.results[0].formatted_address;

      // Output to app  
      let formattedAddressOutput = `
      <ul class="list-group">
        <li class="list-group-item">${formattedAddress}</li>
      </ul>
    `;

      // Address Components
      // let addressComponents = response.data.results[0].address_components;

      // Output to app
      // let addressComponentsOutput = '<ul class="list-group">';
      // for (let i = 0; i < addressComponents.length; i++) {
      //   addressComponentsOutput += `
      //   <li class="list-group-item"><strong>${addressComponents[i].types[0]}</strong>:
      //     ${addressComponents[i].long_name}
      //   </li>
      // `;
      // }
      // addressComponentsOutput += '</ul>';

      // Geometry
      let lat = response.data.results[0].geometry.location.lat;
      let lng = response.data.results[0].geometry.location.lng;
      let geometryOutput = `
        <ul class="list-group">
          <li class="list-group-item"><strong>Latitude</strong>:${lat}</li>
          <li class="list-group-item"><strong>Longtitude</strong>:${lng}</li>
        </ul>
    `;

      // innerHTML Output
      document.getElementById('formatted-address').innerHTML = formattedAddressOutput;
      // document.getElementById('address-components').innerHTML = addressComponentsOutput;
      document.getElementById('geometry').innerHTML = geometryOutput;

      // Init Map
      document.getElementById('map').style.visibility = "visible";
      console.log(lat, lng);
      initMap(location, lat, lng)
    })
    .catch(function (error) {
      console.log(error);
    })
}

function initMap(location, lat_data, lng_data) {
  console.log(lat_data, lng_data);
  console.log(location);

  // Map options
  var options = {
    zoom: 8,
    center: {
      lat: lat_data,
      lng: lng_data
    }
  }

  // New map
  map = new google.maps.Map(document.getElementById('map'), options);
  // const location = 'busan'

  const marker = {
    coords: {
      lat: lat_data,
      lng: lng_data
    },
    // const location = "<?php echo $_SESSION['cur_locale'];?>";
    content: '<h1>Lynn MA</h1>'
  }
  console.log(marker);

  addMarker(marker);
}

function addMarker(props) {
  var marker = new google.maps.Marker({
    position: props.coords,
    map: map,
  });

  // Check for customicon
  if (props.iconImage) {
    // Set icon image
    marker.setIcon(props.iconImage)
  }

  // Check content
  if (props.content) {
    var infoWindow = new google.maps.InfoWindow({
      content: props.content
    });

    marker.addListener('click', function () {
      infoWindow.open(map, marker);
    });
  }
}


$(document).ready(function () {
  const mapInput = document.getElementById('mapInput');
  console.log(mapInput);
  geocodeDefault(mapInput.value)
});