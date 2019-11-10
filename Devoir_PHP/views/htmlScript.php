<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
	// Permet de rediriger si page tache vide
	function redirectionTacheVide(href){
		const bouton = document.querySelector('#tacheVide');

		bouton.addEventListener('click', function(){
			if (href !== ""){
				location.href = "?page=" + href;
			} else {
				location.href = "?page";
			}
		});
	}
</script>
</body>
</html>