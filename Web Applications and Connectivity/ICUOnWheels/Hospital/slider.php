<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  .carousel-caption{
    font-family: 'DidactGothic';
  }
  </style>
</head>
<body>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
	  <li data-target="#myCarousel" data-slide-to="4"></li>
      <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="images/home_neonatal.jpeg" alt="Neonatal ICU Bed">
        <div class="carousel-caption">
          <h3>Neonatal ICU</h3>
          <p>This specialty unit cares for neonatal patients who have not left the hospital after birth. Common conditions cared for include prematurity and associated complications, congenital disorders such as Congenital diaphragmatic hernia, or complications resulting from the birthing process</p>
        </div>
      </div>

      <div class="item">
        <img src="images/home_pediatric.jpg" alt="Pediatric ICU bed">
        <div class="carousel-caption">
          <h3>Pediatric ICU</h3>
          <p> Pediatric patients are treated in this intensive care unit for life-threatening medical problems such as asthma, influenza, diabetic ketoacidosis, or traumatic brain injury. Surgical cases may also be transferred to the PICU postoperatively if the patient has a potential for rapid deterioration and requires more frequent monitoring, such as in spinal fusions or surgeries involving the airway such as removal of the tonsils or adenoids. Some facilities also have specialized pediatric cardiac intensive care units, where patients with congenital heart disease are cared for. These units also typically handle cardiac transplantation and postop care of cardiac catheterization patients if those services are offered at the hospital.</p>
        </div>
      </div>
    
      <div class="item">
        <img src="images/home_psychiatric.jpeg" alt="Psychiatric ICU bed">
        <div class="carousel-caption">
          <h3>Psychiatric ICU</h3>
          <p>Patients who may voluntarily harm themselves are delivered here so they can be monitored more vigorously. Patient rooms are locked, preventing escaping.</p>
        </div>
      </div>

      <div class="item">
        <img src="images/home_coronary.jpg" alt="Coronary ICU bed">
        <div class="carousel-caption">
          <h3>Coronary ICU</h3>
          <p>Also known as Cardiac Intensive Care Unit (CICU) or Cardiovascular Intensive Care Unit (CVICU), this ICU caters to patients specifically with congenital heart defects or life-threatening acute conditions such as cardiac arrest.</p>
        </div>
      </div>
  
  <div class="item">
        <img src="images/home_neuro.JPG" alt="Neuri ICU bed">
        <div class="carousel-caption">
          <h3>Neuro ICU</h3>
          <p>Patients here are treated for aneurysms, brain tumors, stroke, rattlesnake bites and post surgical patients who have undergone various neurological surgeries and require hourly neurological exams. Many nurses who work within these units have neurological intensive care certifications. Once the patients are more stable and off the ventilator, they are transferred to a neurological care unit.</p>
        </div>
      </div>
    
      <div class="item">
        <img src="images/home_surgical.jpg" alt="Surgical ICU bed">
        <div class="carousel-caption">
          <h3>Surgical ICU</h3>
          <p>A specialized service in larger hospitals that provides inpatient care for critically ill patients on surgical services. As opposed to other ICUs, the care is managed by surgeons trained in critical-care.</p>
        </div>
      </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</body>
</html>
