document.addEventListener("DOMContentLoaded", function () {
    // JavaScript code here
    const radio1 = document.getElementById('RBSE');
    const radio2 = document.getElementById('RBPFE');
    const tableSE = document.getElementById('TSE');
    const tablePFE = document.getElementById('TPFE');
    const FormSE = document.getElementById('FormSE');
    const FormPFE = document.getElementById('FormPFE');
    
    radio1.addEventListener('change', () => {
        if (radio1.checked) {
            tableSE.style.display = 'block';
            tablePFE.style.display = 'none';
            FormSE.style.display ='block';
            FormPFE.style.display ='none';
        }
    });
    
    radio2.addEventListener('change', () => {
        if (radio2.checked) {
            tableSE.style.display = 'none';
            tablePFE.style.display = 'block';
            FormSE.style.display ='none';
            FormPFE.style.display ='block';
        }
    });
});
//charts creation :
    function CreateChart(x ,y){
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['etudiants qui ont trouver un stage ', 'etudiants qui n ont pas trouver un stage'],
                datasets: [{
                    data: [x, y],
                    backgroundColor: [
                        'rgb(59,130,246)',
                        'rgb(36,23,0)'
                    ]
                }]
            }
        });
    } 
    function CreateSecondChart( x1 ,y1){
        // second chart
        //var x1 = <?php echo $found_stage2; ?>;
        //var y1 = <?php echo $didnt_find_stage2; ?>;
        var ctx2 = document.getElementById('myPieChart2').getContext('2d');
        var myPieChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['etudiants qui ont trouver un stage ', 'etudiants qui n ont pas trouver un stage'],
                datasets: [{
                    data: [x1, y1],
                    backgroundColor: [
                        'rgb(59,130,246)',
                        'rgb(36,23,0)'
                    ]
                }]
            }
        });
    }
    //generate Bar Charts
    function BarChart(var1,var2,var3,var4,var5){
        
        // Get the context of the canvas element we want to select
        var ctx = document.getElementById('myBarChart').getContext('2d');
        ctx.canvas.width = 600;
        ctx.canvas.height = 300;
        // Define the data for the bar chart
        var data = {
            labels: ['1er anne', '2eme anne', '3eme anne', '4eme anne', '5eme anne'],
            datasets: [{
            label: 'Nombre d\'etudiants qui ont trouver un stage  ',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [var1,var2,var3,var4,var5]
            }]
        };
    
        // Configure the options for the bar chart
        var options = {
            scales: {
            y: {
                beginAtZero: true
            }
            }
        };
    
        // Create a new bar chart
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
        
    }
      
    


