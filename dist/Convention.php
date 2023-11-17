<?php 
  require "src/db.php";
  require "src/downloadPdf.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des conventions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="CSS/Style.css">
    <script src="src/myscript.js"></script>
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
    <p class="text-4xl mb-6 text-black text-center bg-green-600 flex justify-center h-20 p-5">gestion des Convention </p>
    <div class="ml-64 ">
      
      <!--recherchre -->
      <div class="">

        <form action="" method="post" class="flex justify-center  w-full mt-10">
          <p class="text-2xl mt-6 mb-6 ml-8 font-bold ">search:</p>
          <input class="ml-4 border-2 w-40 h-8 mt-6 border-red-600 rounded-md" name="thename" type="text">
        </form>
      </div>
      <!-- radio botton -->

      <!--tables of content-->
      <!--table of SE-->
        <div class=" ml-8 mt-8  " id="TSE" style="display :block;">
            <table class="text-left border-separate border-2 ml-32" >
                <thead class="bg-green-600 flex text-black font-bold  ">
                    <tr class="grid grid-cols-7 gap-0 text-center ">
                        <th class="p-4 border border-slate-600 w-44">matricule</th>
                        <th class="p-4 border border-slate-600 w-44">Nom & prenom </th>
                        <th class="p-4 border border-slate-600 w-44">Entreprise</th>
                        <th class="p-4 border border-slate-600 w-44">sujet</th>
                        <th class="p-4 border border-slate-600 w-44">date debut</th>
                        <th class="p-4 border border-slate-600 w-44">date fin</th>
                        <th class="p-4 border border-slate-600 w-44">telecharger:</th>

                    </tr>
                </thead>
                <tbody class="bg-gray-400 text-black flex flex-col overflow-y-scroll " style="height: 50vh;">
                    <?php
                        $req="SELECT * FROM stage where entreprise is not null  order by matricule ";
                        $result =$pdo->prepare($req);
                        $result->execute();
                        $student = $result->fetchAll(PDO::FETCH_OBJ);
                    ?>
                    <?php foreach($student as $p):?>
                        <tr class="grid grid-cols-7 gap-0 ">
                            <td class="p-4 w-44"><?=$p->matricule?></td>
                            <td class="p-4 w-44 "><?=$p->nom?></td>
                            <td class="p-4 w-44 "><?=$p->entreprise?></td>
                            <td class="p-4 w-44 "><?=$p->sujet?></td>
                            <td class="p-4 w-44 "><?=$p->datedebut?></td>
                            <td class="p-4 w-44 "><?=$p->datefin?></td>
                            <td class="p-4 w-44 ">
                                <form action="" method="post">
                                    <input type="hidden" name="matricule" value="<?=$p->matricule?>">
                                    <input type="submit" name="download" value="telecharger" class="bg-slate-400 font-mono font-bold w-full h-full p-2 text-xl">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    
    
</body>
</html>