// Recup form, nom des taches et l'affichage des taches
const formAjoutTodos = document.querySelector('#formAddTodos');
const nomAjoutTache = document.querySelector('#nomTodos');
const tacheAjoute = document.querySelector('#todos');
// Recup de la popup
const divPopUpTag = document.querySelector('.confirm-popup');
// tableau contenant les checkboxes cochées
let tabCheckbosCoche = "";

// fonction declanché quand ajout tache
formAjoutTodos.addEventListener('submit', function (event) {
	// annule le submite du formulaire
	event.preventDefault();

	// Si le nom de la tache est inferieur a 3 caracteres on ne fait rien
	if (nomAjoutTache.value.length < 3 || nomAjoutTache.value.trim().length < 3) {
		return;
	}

	// Affichage de la tache avec fonction quand clique sur checkboxe
	tacheAjoute.innerHTML += '<div class="todo"><input class="box" type="checkbox" onclick="check()"><p name="tacheCreee">' + nomAjoutTache.value + '</p><button onclick="deleteTodo(this.parentNode)">&times;</button></div>';

	// Enlève le nom de l'imput
	nomAjoutTache.value = '';

	// Enregistre la liste des taches
	localStorage.setItem('nomAjoutTaches', tacheAjoute.innerHTML);

	// recharge de la page
	window.location.reload();

}, false);

// Verification si la liste des taches est enregistrée
let saved = localStorage.getItem('nomAjoutTaches');

// Si enregistré, affiche la liste
if (saved) {
	tacheAjoute.innerHTML = saved;
}

// Modifie les checkboxes si cochées
tabCheckbosCoche = JSON.parse(localStorage.getItem('checked')) || [];
tabCheckbosCoche.forEach(function(checked, i) {
	$('.box').eq(i).prop('checked', checked);
});

// Fonction pour supprimer une tache
let todoToDelete = null;
function deleteTodo(todoTag){
	// suppression de la tache si elle n'est pas cochée sinon affiche la popup de suppression
	if (todoTag && !todoTag.firstElementChild.checked){
		tacheAjoute.removeChild(todoTag);
	} else if (todoTag) {
		divPopUpTag.style.display = 'block';
		todoToDelete = todoTag;
	} else {
		tacheAjoute.removeChild(todoToDelete);
		closePopup();
	}
	// Mise à jour des taches et checkboxes
	localStorage.setItem('nomAjoutTaches', tacheAjoute.innerHTML);
	check();
	// recharge de la page
	document.reload();
}

// FOnction pour fermer la popup
function closePopup(){
	divPopUpTag.style.display = '';
}

// Fonction pour verifier si checkbox est cochée
function check(){
	// creation tableau qui aura toutes les checkbox cochées
	tabCheckbosCoche = $('.box').map(function() {
		return this.checked;
	}).get();
	// Enregistrement du tableau
	localStorage.setItem("checked", JSON.stringify(tabCheckbosCoche));
}