</body>

<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
 
<script>
    function loadFile(event){
        let output = document.getElementById("output");

        var reader = new FileReader();
        reader.onload = function(){
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.file[0]);
    }
</script>

</html>