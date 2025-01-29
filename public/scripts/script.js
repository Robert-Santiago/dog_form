$( document ).ready(function() {
    console.log( "ready!" );

    fetchBreeds(); // fetch breeds on page load

    $('.generate-dog').click(function() {
      const breed = $('#breedSelect').val(); // get selected breed

      if (breed) {
          $.ajax({
              url: '/fetch_dog', // URL of the Laravel endpoint
              type: 'GET',
              data: { breed: breed }, // pass selected breed as query parameter
              success: function(response) {
                  if (response.image_url) {
                     $('#image-container').html(''); // clear previous images

                      const imgElement = $('<img>').attr('src', response.image_url).attr('alt', 'Dog Image').css('max-width', '500px'); // Create a new img element with the fetched URL

                       $('#image-container').append(imgElement); // append the img element to the container
                  } 
                  else {
                      console.error('Failed to fetch image:', response.error);
                  }

                  console.log(response); // log the response for debugging
              },
              error: function(xhr) {
                  console.error('Error:', xhr.responseText);
              }
          });
      } else {
          alert('Please select a breed!');
      }
  });

  
  function fetchBreeds() { // function to fetch dog breeds and populate the dropdown
      $.ajax({
          url: '/fetch_breeds', // endpoint to fetch the breeds list
          type: 'GET',
          success: function(response) {
              if (response.breeds) {
                  const breedSelect = $('#breedSelect');

                  for (let breed in response.breeds) { // loop through the breeds and create an option for each one
                      let option = $('<option>').val(breed).text(breed.charAt(0).toUpperCase() + breed.slice(1));
                      breedSelect.append(option);
                  }
              } 
              else {
                  console.error('Failed to load breeds:', response.error);
              }
          },
          error: function(xhr) {
              console.error('Error fetching breeds:', xhr.responseText);
          }
      });
  }
});