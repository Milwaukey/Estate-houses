
        ajProperties = JSON.parse(sjProperties); // Convert the text into a object
        console.log(ajProperties);


              mapboxgl.accessToken = 'pk.eyJ1IjoibWlsd2F1a2V5IiwiYSI6ImNrMGM1ZXd1ejB5bWozbW52aWpiZ2k5dTMifQ.yYvnaI2O4MNtbugPrLXzQg';
              var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/milwaukey/ck0c6i9oy415i1dmvh793vrjq',
                center: [12.537753, 55.703888], // starting position  {lat: 55.703888, lng: 12.537753},
                zoom: 7 // starting zoom
              });

              map.addControl(new mapboxgl.NavigationControl());


            // JSON WORKS WITH FOR IN LOOPS 
            // ARRAYS WORKS WITH FOREACH OR FOR OF
            for( let jProperty of ajProperties ) { // JSON OBJECT WITH JSON OBJECTS IN IT 

                    // THE MARKER COMES FROM THE ARRAY IN THE JSON FILE

                    // create a DOM element for the marker
                    var el = document.createElement('div');

                    el.className = 'marker';

                    el.style.backgroundImage = 'url(images/uploadedImages/agent-images/properties/'+jProperty.images[0]+')';
                    el.style.width = '50px';
                    el.style.height = '50px';
                    el.id = jProperty.id;

                    // CLICK
                    el.addEventListener('click', function() {
                        removeActiveClassFromProperty();
                        console.log(`Hightlight property with id: ${this.id}`);
                        document.getElementById(this.id).classList.add('active'); 
                        document.getElementById('Right'+this.id).classList.add('active'); // We add V- in front, because else it won't work because you can't have too ID's
                    });

                    // add marker to map
                    new mapboxgl.Marker(el).setLngLat(jProperty.geometry.coordinates).addTo(map);


            } // END LOOP







             // $('.active').removeClass('.active')
            function removeActiveClassFromProperty(){
                    let properties = document.querySelectorAll('.active')
                    properties.forEach( function( oPropertyDiv ) {
                        oPropertyDiv.classList.remove('active')
            } )
        }
