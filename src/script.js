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
            console.log("errerre");
            tableSE.style.display = 'block';
            tablePFE.style.display = 'none';
            FormSE.style.display ='block';
            FormPFE.style.display ='none';
        }
    });
    
    radio2.addEventListener('change', () => {
        if (radio2.checked) {
            console.log("tototot");
            tableSE.style.display = 'none';
            tablePFE.style.display = 'block';
            FormSE.style.display ='none';
            FormPFE.style.display ='block';
        }
    });
});


