<?php 
  require 'src/CrudFunctions.php';
  require 'src/filter.php';
  require "src/db.php";
  $student ;
  $req="SELECT * FROM etudiants order by matricule";
  $result =$pdo->prepare($req);
  $result->execute();
  $student = $result->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="output.css">
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body style="font-family: 'Sometype Mono', monospace;" class="">
  <div class="">
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
    
    <div class="ml-64  ">
      <div class="bg-green-600 w-full">
      <p class="text-4xl font-bold bg-green-600  h-20 pt-5 text-black flex justify-center" >gestion des etudiants</p>
      </div>

      <!--recherchre -->
      <div class="grid grid-cols-4 gap-5 mt-10">
        <form action="" method="post" class="flex col-start-2">
          <input class=" border-2 border-green-600 w-full h-full rounded-md pl-36 text-xl font-serif font-bold" name="thename" type="text" placeholder="search by name">
          <?php $student=searchByName($student); ?>
        </form>

        <form action="" class="flex" method="post">
          <select id="underline_select" name="class" class=" text-center hover:bg-green-600 hover:text-black hover:font-bold  py-2.5 w-full h-full text-xl font-serif font-bold text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            <option selected value="all" >Class</option>
            <?php foreach ($FIL as $f) : ?>
              <option value="<?=$f?>"><?=$f?></option>
            <?php endforeach?>
          </select>
          <input type="submit" value="filtre" name="filtre" class=" border-2 w-20  h-full bg-green-700 text-white font-bold">
          <button ></button>
          <?php $student=filterClass($student);?>
        </form>

      </div>

      <div class=" ml-8 mt-8 w-full ">
      <table class="text-left w-full border-separate border-2">
        <thead class="bg-green-600 flex text-black font-bold w-full">
          <tr class="flex w-full text-center">
            <th class="border border-slate-600 p-4 w-1/4">matricule</th>
            <th class="p-4 w-1/4 border border-slate-600">Nom complet </th>
            <th class="p-4 w-1/4 border border-slate-600">email</th>
            <th class="p-4 w-1/4 border border-slate-600">group</th>
            <th class="p-4 w-1/4 border border-slate-600">filere</th>
            <th class="p-4 w-1/4 border border-slate-600">annee scolaire</th>
          </tr>
        </thead>
          <tbody class="bg-gray-400 text-black flex flex-col items-center overflow-y-scroll  w-full" style="height: 50vh;">
            <?php foreach($student as $p):?>
              <tr class="flex w-full">
                  <td class="p-4 w-1/6  ml-3 "><?=$p->matricule?></td>
                  <td class="p-4 w-1/6  ml-3 "><?=$p->nom?></td>
                  <td class="p-4 w-1/6  ml-3 "><?=$p->email?></td>
                  <td class="p-4 w-1/6  ml-3 "><?=$p->group?></td>
                  <td class="p-4 w-1/6  ml-3 "><?=$p->class?></td>
                  <td class="p-4 w-1/6  ml-3 "><?=$p->anneScolaire?></td>
              </tr>
            <?php endforeach ?>
        </tbody>
      </table>
    </div>

    <!--formulaire pour entrer -->

    <div class="bg-slate-500 ml-52  mr-6  mt-5 w-1/2 ">
      <form class="ml-4 p-2 mb-3 " method='POST' action="" enctype="multipart/form-data">
      <div class="grid gap-2 grid-cols-4">
            <label for=""> id</label>
            <input class="m" type="text" name='id'>
            <label class="" for="">nom</label>
            <input class="" type="text" name='nom'>
            <label for="">annee scolaire</label>
            <input class="" type="text" name='anneScolaire'>
            <label class=" " for="">email</label>
            <input class="" type="text" name='email'>
            <label class="" for="">class</label>
            <!--select class-->
            <select id="underline_select" name="class" class=" text-center  block  font-bold  text-sm text-black bg-white border-0  focus:outline-none focus:ring-0 focus:border-gray-200 ">
              <option selected >Class</option>
              <?php foreach ($FIL as $f) : ?>
                <option value="<?=$f?>"><?=$f?></option>
              <?php endforeach?>
            </select>
          <!-- end select -->
            <label class="" for="">group</label>
            <input class="" type="text" name='group'>
        </div>
        <!-- buttons contanier -->
        <div class="ml-36 flex mt-5">
          <input class="font-bold w-24 bg-green-500 text-white mt-2 mb-2 p-2" type="submit" name="add" value="Add">
          <?php insertData();?>
          <input class="font-bold w-24 bg-blue-400 text-black mt-2 mb-2 p-2" type="submit" name="modify" value="Modify">
          <?php modifydata();?>
          <input class="font-bold w-24 bg-red-500 text-white mt-2 mb-2 p-2" type="submit" name="delete" value="delete">
          <?php delete();?>
          
          <!-- test import-->
          <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" class="ml-2 block w-1/3 h-1/5  bg-slate-400 border border-none mt-1 py-2 px-3 rounded">
          <input class="font-bold w-24 bg-slate-400  ml-2 text-white mt-2 mb-2 p-2" type="submit" name="import" value="import">
          <?php import();?>
        </div>

        

      </form>
    </div>
  </div>
  <!--formulaire End -->
  </div>
</body>

</html>