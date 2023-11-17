<?php 
  require 'src/SE_Functions.php';
  require 'src/PFE_Functions.php';
  require 'src/filter.php';
  require "src/db.php";
  require "src/Stats.php";

  $student ;
  $req="SELECT * FROM stage order by matricule ";
  $result =$pdo->prepare($req);
  $result->execute();
  $student = $result->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Sometype+Mono:wght@600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="src/myscript.js" ></script>
  <script src="myscript.js" ></script>

</head>

<body class="">
  <div >
    <!-- this is a fixed Navigation bar at the right -->
    <div class="NavBar w-64 bg-green-600 h-screen fixed top-0 left-0 p-4 ">
      <ul class="text-black font-extrabold mb-9">
        <li class="mb-36 bg-white ">
          <a href="https://www.emsi.ma/">
            <img src="https://www.emsi.ma/wp-content/uploads/2020/07/logo-1.png" alt="EMSI Logo">
          </a>
        </li>
        <li class="mb-36">
          <a href="etudiant.php">Gestion des etudiants</a>
        </li>
        <li class="mb-36">
          <a href="GestionStage.php">Gestion des stage</a>
        </li>
        <li class="mb-36">
          <a href="Convention.php">Gestion des conventions</a>
        </li>
      </ul>
    </div> 
    <!--the end of NavBar-->   

    <!-- gestion des etudiants  -->
    <!-- afficher les stagiaires dans un tableau-->
    <p class="text-4xl font-bold bg-green-600  h-20 pt-5 text-black flex justify-center" style="font-family: 'Sometype Mono', monospace;">gestion des stage</p>
    <div class="ml-64 ">
      <!--recherchre -->
      <div class="">
        <form action="" method="post" class="flex justify-center  w-full mt-10">
          <p class="text-2xl mt-6 mb-6 ml-8 font-bold ">search:</p>
          <input class="ml-4 border-2 w-40 h-8 mt-6 border-red-600 rounded-md" name="thename" type="text">
          <?php $student=searchByNameStage($student); ?>
        </form>
      </div>
      <!-- radio botton -->
      <div class="flex justify-center " id="1">
        <div class="flex items-center pl-4 border border-gray-200 rounded bg-green-500  w-1/4">
          <input id="RBSE" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
          <label for="RBSE" class="w-full py-4 ml-2 flex justify-center font-medium text-gray-900 text-lg">stage d'ete </label>
        </div>
        <div class="flex items-center pl-4 border border-gray-200 rounded bg-green-500  w-1/4 ">
          <input id="RBPFE" type="radio" value="" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
          <label for="RBPFE" class="w-full py-4 ml-2 flex justify-center font-medium text-gray-900 text-lg">PFE</label>
        </div>

      </div>
      <!--tables of content-->
      <!--table of SE-->
      <div class=" ml-8 mt-8  " id="TSE" style="display :block;">
      <table class="text-left border-separate border-2" >
        <thead class="bg-green-600 flex text-black font-bold  ">
          <tr class="grid grid-cols-9 gap-0 text-center ">
            <th class="p-4 border border-slate-600 w-44">matricule</th>
            <th class="p-4 border border-slate-600 w-44">Nom & prenom </th>
            <th class="p-4 border border-slate-600 w-44">Entreprise</th>
            <th class="p-4 border border-slate-600 w-44">sujet</th>
            <th class="p-4 border border-slate-600 w-44">date debut</th>
            <th class="p-4 border border-slate-600 w-44">date fin</th>
            <th class="p-4 border border-slate-600 w-44">convention empruntee </th>
            <th class="p-4 border border-slate-600 w-44">convention recu </th>
            <th class="p-4 border border-slate-600 w-44">observation</th>
          </tr>
        </thead>
        <tbody class="bg-gray-400 text-black flex flex-col overflow-y-scroll " style="height: 50vh;">
          <?php
            $req="SELECT * FROM stage where nature='se' order by matricule ";
            $result =$pdo->prepare($req);
            $result->execute();
            $student = $result->fetchAll(PDO::FETCH_OBJ);
          ?>
          <?php foreach($student as $p):?>
            <tr class="grid grid-cols-9 gap-0 ">
              <td class="p-4 w-44"><?=$p->matricule?></td>
              <td class="p-4 w-44 "><?=$p->nom?></td>
              <td class="p-4 w-44 "><?=$p->entreprise?></td>
              <td class="p-4 w-44 "><?=$p->sujet?></td>
              <td class="p-4 w-44 "><?=$p->datedebut?></td>
              <td class="p-4 w-44 "><?=$p->datefin?></td>
              <td class="p-4 w-44 "><?=$p->convention_empruntee?></td>
              <td class="p-4 w-44 "><?=$p->convention_recu?></td>
              <td class="p-4 w-44 "><?=$p->observation?></td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <!-- table of content -->
    
    <!--Table of PFE-->
      <div class="ml-8 mt-8" id="TPFE" style="display: none;">
        <table class="text-left border-separate border-2">
          <thead class="bg-green-600 text-black font-bold">
            <tr class="grid grid-cols-12 text-center ">
              <th class="p-4 w-32 border border-slate-600 ">matricule</th>
              <th class="p-4 w-32 border border-slate-600">Nom & prenom</th>
              <th class="p-4 w-32 border border-slate-600">Entreprise</th>
              <th class="p-4 w-32 border border-slate-600">sujet</th>
              <th class="p-4 w-32 border border-slate-600">duree</th>
              <th class="p-4 w-32 border border-slate-600">date debut</th>
              <th class="p-4 w-32 border border-slate-600">date fin</th>
              <th class="p-4 w-32 border border-slate-600">convention empruntee </th>
              <th class="p-4 w-32 border border-slate-600">convention recu </th>
              <th class="p-4 w-32 border border-slate-600">fiche</th>
              <th class="p-4 w-32 border border-slate-600">encadrant ecole </th>
              <th class="p-4 w-32 border border-slate-600">encadrant stage </th>
            </tr>
          </thead>
          <tbody class="bg-gray-400 text-black flex flex-col overflow-y-scroll" style="height: 50vh; ">
          <?php
              $req="SELECT * FROM stage where nature='pfe' order by matricule ";
              $result =$pdo->prepare($req);
              $result->execute();
              $student = $result->fetchAll(PDO::FETCH_OBJ);
            ?>
            <?php foreach ($student as $p): ?>
              <tr class="grid grid-cols-12">
                <td class="p-4 w-32 "><?=$p->matricule?></td>
                <td class="p-4 w-32 "><?=$p->nom?></td>
                <td class="p-4 w-32 "><?=$p->entreprise?></td>
                <td class="p-4 w-32 "><?=$p->sujet?></td>
                <td class="p-4 w-32 "><?=$p->duree?></td>
                <td class="p-4 w-32 "><?=$p->datedebut?></td>
                <td class="p-4 w-32 "><?=$p->datefin?></td>
                <td class="p-4 w-32 "><?=$p->convention_empruntee?></td>
                <td class="p-4 w-32 "><?=$p->convention_recu?></td>
                <td class="p-4 w-32 "><?=$p->fiche?></td>
                <td class="p-4 w-32 "><?=$p->encadrant_ecole?></td>
                <td class="p-4 w-32 "><?=$p->encadrant_de_stage?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <div class="flex">
      <!--formulaire pour Stage d'ete -->
        <div class="bg-slate-500 ml-8  mr-6  mt-5 w-1/2 " id="FormSE">
          <p class="flex justify-center bg-stone-900 w-full fonr-bold p-2 mb-2 text-lg text-green-600">Stage d'ete Form :</p>
          <form class="ml-4 p-2 mb-3 font-bold " method='POST' action="">
            <div class="grid gap-2 grid-cols-4">
              <!--inputs and labels-->
              <label for=""> matricule</label>
              <input class="" type="text" name='matricule'>

              <label for="">entreprise</label>
              <input class="" type="text" name='entreprise'>

              <label class=" " for="">sujet</label>
              <input class="" type="text" name='sujet'>
              
              <label class="" for="">date Debut</label>
              <input class="" type="date" name='datedebut'>

              <label class="" for="">date Fin</label>
              <input class="" type="date" name='datefin'>
              
              <label class="" for="">convention empruntee</label>
              <select id="Cnveid" name="cnve" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>

              <label class="" for="">convention recu</label>
              <select id="Cnvrid" name="cnvr" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <label class="" for="">observation</label>
              <input class="" type="text" name='observation'>
              <label class="" for="">nature</label>
                  <select id="" name="nature" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                    <option selected ></option>
                    <option value="pfe">pfe</option>
                    <option value="se">se</option>
                  </select>
            </div>

            <!-- buttons contanier -->
            <div class=" grid grid-cols-4 mt-5 gap-0">

              <input class="font-bold col-start-2 rounded-md h-16 bg-green-400 text-black mt-2 mb-2 p-2" type="submit" name="modifyStageSE" value="Modify">
              <?php modifydataStage();?>
              <input class="font-bold rounded-md h-16 bg-blue-500 text-white mt-2 mb-2 p-2" type="submit" name="deleteStageSE" value="delete">
              <?php DeleteDataStage();?>
              
            </div>

            

          </form>
        </div>
            <!--formulaire pour Stage PFE -->

        <div class="bg-slate-500 ml-8  mr-6  mt-5 w-1/2 " id="FormPFE" style="display: none;">
          <p class="flex justify-center bg-stone-900 w-full fonr-bold p-2 mb-2 text-lg text-green-600">Stage PFE Form :</p>
          <form class="ml-4 p-2 mb-3 font-bold " method='POST' action="">
            <div class="grid gap-2 grid-cols-4">
              <label for=""> matricule</label>
              <input class="" type="text" name='matricule'>
              <label for="">entreprise</label>
              <input class="" type="text" name='entreprise'>
              <label class=" " for="">sujet</label>
              <input class="" type="text" name='sujet'>
              <!--select -->
              <label class=" " for="">duree</label>
              <select id="dureeid" name="duree" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="4m">4 mois</option>
                <option value="6m">6 mois</option>
              </select>
              <!-- end select -->
              <label class="" for="">date Debut</label>
              <input class="" type="date" name='datedebut'>
              <label class="" for="">date Fin</label>
              <input class="" type="date" name='datefin'>
              <!--cs-->
              <label class="" for="">convention empruntee</label>
              <select id="Cnveid" name="cnve" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <label class="" for="">convention recu</label>
              <select id="Cnvrid" name="cnvr" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <label class="" for="">fiche</label>
              <select id="" name="fiche" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="oui">oui</option>
                <option value="non">non</option>
              </select>
              <label class="" for="">encadrant ecole</label>
              <?php
                $req="SELECT * FROM encadrants ";
                $result =$pdo->prepare($req);
                $result->execute();
                $student = $result->fetchAll(PDO::FETCH_OBJ);
              ?>
              <select name="encadrantEcole" id="">
                <option value="" selected >choose encadrant</option>
                <?php foreach ($student as $p): ?>
                <option value="<?=$p->nom?>"><?=$p->nom?></option>
                <?php endforeach ?>
              </select>
              <label class="" for="">encadrant de stage</label>
              <input class="" type="text" name='EncadrantStage'>
              <label class="" for="">nature</label>
              <select id="" name="nature" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
                <option selected ></option>
                <option value="pfe">pfe</option>
                <option value="se">se</option>
              </select>
            </div>
            <!-- buttons contanier -->
            <div class=" grid grid-cols-4 mt-5 gap-0">
              <input class="font-bold col-start-2 rounded-md h-16 bg-green-400 text-black mt-2 mb-2 p-2" type="submit" name="modifyStagePFE" value="Modify">
              <?php modifydataPFE();?>
              <input class="font-bold rounded-md h-16 bg-blue-500 text-white mt-2 mb-2 p-2" type="submit" name="deletePFE" value="delete">
              <?php deletePFE();?>
            </div>
          </form>
        </div>
      

        <div class="bg-slate-600  mt-5 w-1/2 flex justify-center ">
        
          <form action="" method="post">
            <div class="mt-10 font-bold">
              <label for="">Encadrant nom</label><br>
              <input type="text" name="nom" class="p-2 rounded-lg pl-12 " placeholder="ajouter le nom ici"><br>
                <input type="submit" name="submit" class=" bg-green-500 text-slate-200 rounded mt-4 w-full h-10" value="add">
                <?php addEcnadrant()?>
            </div>
          </form>            
        </div>
      </div>
        <!-- Charts -->
        <div class=" grid grid-cols-4 ml-32 mt-20 ">
          <figure class="highcharts-figure flex justify-center w-1/4 " >
              <div id="container" >
                <canvas id="myPieChart" class="" style="width: 400px; height: 400px;" ></canvas>
              </div>
          </figure>
          <figure class="highcharts-figure flex justify-center w-1/4" >
            <div id="container2" >
              <canvas id="myPieChart2" class="" style="width: 400px; height: 400px;" ></canvas>
            </div>
          </figure>
          <div id="containerBar" style="width: 400px; height: 400px;" >
            <canvas id="myBarChart" >
          </div>
          <div class=" pt-20 pl-20 ">
              <form action="" style=""  method="post">
                <select id="underline_select" name="class" class="mb-8 w-1/2 text-center hover:bg-lime-600 hover:text-black hover:font-bold block py-2.5 px-0  text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                  <option selected value="1AP" >Class</option>
                  <?php foreach ($FIL as $f) : ?>
                    <option value="1AP"><?=$f?></option>
                  <?php endforeach?>
                </select>
                <input type="submit" name="filtre_button" class="w-1/2 bg-lime-600 p-2" value="Generate statistiques">
              </form>
          </div>
        </div>
        <!--Create shapes -->
        <script>
          var x = <?php echo $found_stage; ?>;
          var y = <?php echo $didnt_find_stage; ?>;
          CreateChart(x,y);
          var x1 = <?php echo $found_stage2; ?>;
          var y1 = <?php echo $didnt_find_stage2; ?>;
          CreateSecondChart(x1,y1);
          var1=<?php echo"$FirstYear";?>;
          var2=<?php echo"$SecondYear";?>;
          var3=<?php echo"$ThirdYear";?>;
          var4=<?php echo"$FourthYear";?>;
          var5=<?php echo"$FifthYear";?>;
          BarChart(var1,var2,var3,var4,var5);
        </script>

  </div>
 </div>
</body>
</html>