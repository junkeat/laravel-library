@extends('layouts.app')

@section('home')
    <div class="contact-container">
        <div class="contact-title">
            <h1>Contact Us</h1>
            <p>Lorem ipsum dolor sit amet.</p>
            <a href="#map"><img src="../images/arrowdown.png" class="down-link"></a>
        </div>
    </div>
    
    
    <section class="contact-section">
        <div class="col-md-6" style="padding: 0px;">
            <div id="map"></div>
        </div>
        
        <div class="col-md-6" style="padding: 0px;">
            <div class="info-container">
                <div>
                    <p>ADDRESS</p>
                    <h3>Blok B&C, Lot 5, Seksyen 10, Jalan Bukit,<br> 43000 Kajang, Selangor.</h3>
                </div>
                <div>
                    <p>PHONE</p>
                    <h3>+(60)3-87392770</h3>
                </div>
                <div>
                    <p>EMAIL</p>
                    <h3>neuc@newera.edu.my</h3>
                </div>
                <div>
                    <p>OFFICE HOURS</p>
                    <h4>Monday to Friday: 8:30am - 12:00pm; 1:00pm - 5:00pm <br> Saturday: 8:30am - 12:30pm</h4>
                    <small>(Off on Sunday and public holidays)</small>
                </div>
            </div>
        </div>
    </section>

    <div style="clear:both;"></div>

    <section class="social-media-section">
        <h3>Social Media</h3>
        <div class="social-media-links">
            <a href="https://www.facebook.com"><img src="../images/facebook.png"></a>
            <a href="https://www.twitter.com"><img src="../images/twitter.png"></a>
            <a href="https://www.instagram.com"><img src="../images/instagram.png"></a>
            <a href="https://www.whatsapp.com"><img src="../images/whatsapp.png"></a>
        </div>
    </section>
    

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 2.9885, lng: 101.7952},
            zoom: 16,
            marker: {lat: 2.9885, lng: 101.7952}
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsfFlRpA2-r7j3IzdPuP6JcFZcrZ-ZHps&callback=initMap"
    type="text/javascript"></script>
@endsection