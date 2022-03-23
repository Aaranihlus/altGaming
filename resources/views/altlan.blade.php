@extends('layouts.alt-main')

@section('content')

<h1 style="position: fixed; left: 25px; top: 25px; z-index: 9999;"><a href="/"><i class="far fa-times-circle"></i></a></h1>

<div style="width: 100vw; height: 100vh; background-image: url('images/main-opt.jpg'); background-position: center; background-size: cover;
background-repeat: no-repeat; align-content: center; padding:0; margin:0;" id="box0">

  <div style="display: flex; flex-direction: column; flex-wrap: nowrap; width: 100%; height: 100%; justify-content: center; align-items: center; background:rgba(0,0,0,0.85);">

    <img src="https://altlan.co.uk/content/uploads/2021/03/logo.png" alt="" style="width: 30vw; max-width: 200px;">

    <h1 style="color: white;">
      <div class="altlan" style="text-align: center; font-size: 2.5em;">
        <span class="alt" style="color: white; font-family: thinfont;">alt<span style="font-weight: bold; color: white; font-family: boldfont;">LAN #9</span></span>
      </div>
    </h1>

    <h1 style="color: white;">
      <div class="altlan" style="text-align: center; font-size: 2.5em;">
        <span class="alt" style="font-weight: bold; color: white; font-family: boldfont;">APR <span style="font-weight: bold; color: white; font-family: boldfont;">2022</span></span>
      </div>
    </h1>

    <hr style="height: 4px; width: 25%;">
    <span class="alt" style="color: white; font-family: thinfont; font-size: 2.5em;">Gaming Weekender</span>
    <hr style="height: 4px; width: 25%;">

    <div class="flex-x" style="width: 20%;">
      <button style="width: 100%; height: 50px" type="submit" class="btn btn-warning mx-2"><a href="/shop/tickets">Get Tickets</a></button>
      <!--<button type="submit" class="btn btn-warning mx-2">More Info</button>-->
    </div>

  </div>

</div>


<div style="width: 100vw; height: 40vh; background:black; display: flex; flex-direction: column; flex-wrap: nowrap; align-content: center; justify-content: center; align-items: center; padding:0; margin:0;" id="box1">
  <div id="key_details" class="key_details container">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <h3>Key details</h3>
        <ul class="group headlines">
          <li><span class="date_date">15‑17</span>
            <span class="date_month">April</span>
            <span class="date_year">2022</span>
            <div class="small">(<a href="http://www.google.com/calendar/render?action=TEMPLATE&amp;text=altLAN%209&amp;dates=20220415/20220417&amp;details=&amp;location=Boundless+Outdoors%2C+Worcestershire+DY9+9UU&amp;trp=false&amp;sprop=&amp;sprop=name:" target="_blank" rel="nofollow">Add to calendar</a>)</div>
          </li>
          <li>At <a href="https://goo.gl/maps/4HFYSU2X5ovCK86G8" title="" target="_blank">Boundless Outdoors, Worcestershire DY9 9UU</a></li>
          <li>Stage events</li>
          <li>Friendly competitions and&nbsp;group&nbsp;games</li>
          <li>Saturday Night Quiz</li>
          <li>Big Rockband setup</li>
          <li>The Nail Game</li>
          <li>Firepit</li>
        </ul>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
        <h4>Plus...</h4>
        <ul class="group secondary">
          <li>Beds and showers</li>
          <li>Board games</li>
          <li>Cooked breakfast on Saturday and&nbsp;Sunday</li>
          <li>Small kitchen access, local takeaways and&nbsp;shops&nbsp;nearby</li>
          <li>Parking and outdoor breakout&nbsp;spaces</li>
        </ul>
        <h4><strong>Upgrade to BYOC</strong> for everything from the standard ticket, plus...</h4>
        <ul class="group secondary">
          <li>A dedicated desk space for your computer&nbsp;setup</li>
          <li>Wired network and power within arms&nbsp;reach</li>
          <li>An extra space to call your own for the&nbsp;weekend</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="bgimg-2" style="background-image: url('images/IMG_20180401_194628-1024x768.jpg'); min-height: 400px; position: relative;
  opacity: 0.5;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
</div>

<div style="width: 100vw; min-height: 60vh; background: black; padding: 20px; align-items: center;" id="box2" class="flex-y">

  <div id="gallery" class="gallery">

    <h3>Gallery</h3>
    <p>We're adding more soon</p>

    <div class="flex-x mb-2" style="height: 20vh;">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/DasterdlyJay-1024x552.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0125-768x1024.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/21728110_1339786979453600_6162269120443706677_n.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0144-768x1024.jpg">
    </div>

    <div class="flex-x mb-2" style="height: 20vh;">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0174-1024x768.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0185-1024x768.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0207-1024x768.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0212-1024x886.jpg">
    </div>

    <div class="flex-x mb-2" style="height: 20vh;">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_0566-683x1024.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_20180401_023837-1024x768.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_20180331_223627-768x1024.jpg">
      <img class="mx-2 img-fluid" style="object-fit: cover;" src="images/IMG_20180401_194628-1024x768.jpg">
    </div>

  </div>

</div>


<div class="bgimg-2" style="background-image: url('images/IMG_0207-1024x768.jpg'); min-height: 400px; position: relative;
  opacity: 0.5;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
</div>



<div style="width: 100vw; background: black; padding: 20px; min-height: 40vh; align-items: center; justify-content: center;" id="box3" class="flex-y">

  <div id="checklist" class="checklist">

    <h3>Your essential altLAN survival kit</h3>
    <p>For those that haven’t been before, and for those that need reminding…</p>

    <div class="flex-x">

    <div class="mb-2" style="height: 20vh;">
      <ul>
        <li>Your PC / console (BYOC Ticket Required)</li>
        <li>Control pads</li>
        <li>Games, games, games</li>
        <li>Monitor (around 32 inch is the limit)</li>
        <li>Headphones (low sound from a TV is acceptable)</li>
        <li>4 way power strip</li>
      </ul>
    </div>

    <div class="mb-2" style="height: 20vh; margin-left: 40px;">
      <ul>
        <li>Batteries</li>
        <li>Sleeping bag / Pillow (Bedding is provied with your room)</li>
        <li>Wash kit, Deoderant (The venue has Showers, you can use them..please)</li>
        <li>A change of clothes</li>
        <li>Food (We provide you with access to a fridge and a microwave)</li>
        <li>Drink (This is a Bring your own booze event, there is NO Bar)</li>
      </ul>
    </div>

  </div>

  </div>

</div>




<div class="bgimg-2" style="background-image: url('images/IMG_0185-1024x768.jpg'); min-height: 400px; position: relative;
  opacity: 0.5;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
</div>


<div style="width: 100vw; min-height: 50vh; background: black; padding: 20px; align-items: center;" id="box4" class="flex-y">

  <div id="about" class="about" style="width: 45%; color: white;">

    <h2>What is altLAN?</h2>

    <p style="color: white;">altLAN was born out of the idea of a social event bringing a predominately online community together, to put faces to Online names,
      to have a drink with like-minded friends and talk about life beyond the screen in front of us,
      all whilst showing off our gaming skills (or lack of) in-person.</p>

    <p style="color: white;">Dave (certificate18), Chris (ch8rt) and a handful of legendary volunteers have taken it on a good few steps from there,
      upping the production values and event creativity – along with buckets of effort – to create a weekend like no other.</p>

    <p style="color: white;">With games and events that will bring even the most elusive personalities to the surface, along with the competitive spirits – some known, some not. Chill out
      zones and activities that allow us to simply be around ‘our own kind’. The ultimate challenges of the Nail Game and Quad Shot,
      mixed with the Saturday night quiz, seems to resemble a moshpit more than anything else. Nobody would be surprised if you
      joined the ranks of altLAN legendaries that have muttered the words “I don’t think I turned my computer on… again”.</p>

    <p style="color: white;">We’ve mentioned drink a few times so this should be clear, but altLAN is a strictly over 18s event 😉</p>

    <p style="color: white;">A few words from those that have experienced it first hand…</p>

    <p style="color: white; margin-bottom: 0px; font-style: italic;">"I can’t believe it’s over already, when is the next one?"</p>
    <p>KIRSTY / LILASAUR</p>

    <p style="color: white; margin-bottom: 0px; font-style: italic;">"I’m not sure how I managed to win the QuadShot, I’ve never played any of those games before."</p>
    <p>IAIN / IAIN</p>

    <p style="color: white; margin-bottom: 0px; font-style: italic;">"I need to sleep now."</p>
    <p>JASON / DASTARDLYJAY</p>

    <p style="color: white; margin-bottom: 0px; font-style: italic;">"There aren’t enough words to describe the amount of enjoyment I had."</p>
    <p>KELTON / GOODAY</p>

    <p style="color: white; margin-bottom: 0px; font-style: italic;">"It’s all one big beautiful blur at this point, but I can’t wait for the next one."</p>
    <p>CHAD / CHAD</p>

  </div>

</div>


<div class="bgimg-2" style="background-image: url('images/IMG_0212-1024x886.jpg'); min-height: 400px; position: relative;
  opacity: 0.5;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
</div>

<div style="width: 100vw; min-height: 50vh; background: black; padding: 20px; align-items: center;" id="box5" class="flex-y">

  <div id="faq" class="faq" style="width: 45%; color: white;">

    <h2>Quick fire altLAN Q&A</h2>
    <h3 style="color: #ffc107;">Is there an age limit?</h3>
    <p style="color: white;">We are an over 18’s event. This is a break away from the everyday and a chance to let your hair down so to
      speak and we cannot cater for any youngsters because of this.</p>

    <h3 style="color: #ffc107;">When can I arrive?</h3>
    <p style="color: white;">Scheduled events will begin around 2pm on the Friday, you can arrive before then, and get setup and
      settled in (we’re a friendly bunch), but we may still be dealing with getting everything just right, and we’re not afriad to ask for help 😉

    <h3 style="color: #ffc107;">Can I bring my own food and drink?</h3>
    <p style="color: white;">Absolutely. There is limited kitchen access (think kettle, microwave etc), and we’ll supply some basics for
      tea and coffee. There’s usually a mass takeaway order or two floating around, and of course, there will be a legendary breakfast
      included in the ticket to kick start your Saturday and Sunday mornings.</p>

    <h3 style="color: #ffc107;">What facilities are on offer?</h3>
    <p style="color: white;">It’s not the Ritz, but we have showers, and bathrooms large enough for a strip wash if you prefer.</p>

    <h3 style="color: #ffc107;">What about sleeping?</h3>
    <p style="color: white;">A collection of shared bunk bed rooms down two wings, be prepared to share rooms with a couple of other attendees, but we’re far from crammed in.</p>

    <h3 style="color: #ffc107;">Can I bring a second monitor?</h3>
    <p style="color: white;">Everyone will be greatful if you didn’t. You’ll be encroaching on your neighbours space. A single monitor, below 32inch is sensible.</p>

    <h3 style="color: #ffc107;">Can I bring a mini fridge / heater / fan?</h3>
    <p style="color: white;">Power is a major issue with this much equipment setup, so we can’t accomodate these unfortunately,
      we’ll do everything we can to make you comfortable of course, and there are fridges available, as well as the more low-fi ‘bucket o’ cold water’.</p>

    <h3 style="color: #ffc107;">Is there parking?</h3>
    <p style="color: white;">Yep, right by the main hall as well, we do ask that after you’ve unloaded you move a little further away so
      everyone gets the easiest loading and unloading experience.</p>

    <h3 style="color: #ffc107;">Will my stuff be safe?</h3>
    <p style="color: white;">We have been running these kind of gaming events for many years now and we are pleased to say we have never had any issues regarding missing equipment etc.</p>
    <p style="color: white;">Of course you can never say never and we hope that by having all attendees registered and by having event admins
      always present and the fact that a few people are always awake even in the very late hours your equipment will be safe.</p>

    <h3 style="color: #ffc107;">Are there prizes on offer?</h3>
    <p style="color: white;">Beyond pride and bragging rights? No. We are all about inclusivity at altLAN, and will do everything in our power to
      level the playing field to offer friendly competition that can be enjoyed by everyone.</p>

  </div>

</div>

<div class="bgimg-2" style="background-image: url('images/IMG_20180401_023837-1024x768.jpg'); min-height: 400px; position: relative;
  opacity: 0.5;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
</div>

<div style="width: 100vw; background: black; padding: 20px; align-items: center;" id="box6" class="flex-y">

  <div id="join" class="join" style="width: 45%; color: white;">

    <h2>Join (or follow) us</h2>
    <p style="color: white;">altLAN is fundamentally a community get-together, but we can only do that so often, right? In
      the meantime you can find us lurking in our Discord, playing all manner of games in smaller groups, and
      getting together for quizes, drinking sessions and party games.</p>

    <p style="color: white;">If you don’t fancy getting that close, you can keep tabs on our big movements on Facebook.
      Events and get-togethers will be announced there, even if the good people of Discord find out a little sooner 😉</p>

    <p style="color: white;">Oh, and we also have an article and podcast site over at <a href="https://www.altgaming.uk">altGaming.uk</a></p>

  </div>

</div>

<div style="width: 100vw; background: black; padding: 20px; align-items: center;">
  <p style="text-align: center; color: white;">©2022 altGaming Ltd.</p>
</div>



<!--<div class="bottom-nav" style="  background: blue;
  text-align: center;
  position: fixed;
  bottom: 50px;
  right: 0;
  width: 100vw;
  border: 1px solid #73AD21;">
  <button id="button0">Home</button>
  <button id="button1">Key Details</button>
  <button id="button2">Gallery</button>
  <button id="button3">What is altLAN?</button>
  <button id="button4">Checklist</button>
  <button id="button5">FAQs</button>
  <button id="button6">Join (or follow) us</button>
  <button id="button7">Terms</button>
  <button id="button8">Privacy</button>
</div>-->


<style>
  body {
    margin: 0px;
    padding: 0px;
    color: white;
    overflow-x: hidden;
  }
</style>

<script>
var button0 = document.getElementById("button0");
var button1 = document.getElementById("button1");
var button2 = document.getElementById("button2");
var button3 = document.getElementById("button3");
var button4 = document.getElementById("button4");
var button5 = document.getElementById("button5");
var button6 = document.getElementById("button6");
var button7 = document.getElementById("button7");
var button8 = document.getElementById("button8");

button0.onclick = function(){
  scrollTo("box0");
};

button1.onclick = function(){
  scrollTo("box1");
};

button2.onclick = function(){
  scrollTo("box2");
};

function scrollTo(id){
  var element = document.getElementById(id);
  element.scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});
}


</script>

@endsection
