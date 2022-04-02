import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    connect() {

        //on affiche le formulaire
        console.log(this.element);

        // On va placer un "espion" sur l'élément qui va écouter le 'click' et exécuter une fonction
        this.element.addEventListener("submit", this.handleClick );

    }

    // L'expion fourni à la fonction un Evènement, ici "event"
    handleClick(event){

        // ON annule le comportement par défaut de la soumission d'un formulaire
        event.preventDefault();

        // on récupère le formualaire
        const formulaire = event.target;

        // on affiche le formualaire (console.log() => var_dump())
        console.log(formulaire);

        // On récupère la valeur de l'attribut "action" qui est sur notre balise
        const url = event.target.action;

        const formdata = new FormData( formulaire );

        // On parcours notre formulaire pour afficher dans la console les valeurs (débug)
        for (var [key, value] of formdata.entries()) {
            console.log(key, value);
        }

        const myHeaders = new Headers();

        // Ici on charge notre requête averc la méthode et le contenu (body)
        const myInit = { method: 'POST',
            headers: myHeaders,
            body: formdata
            };

        // On envoie la requête AJAX
        fetch( url, myInit )

            // On extrait le JSON de réponse
            .then( function( response){
                //todo: traiter le cas où une erreur survient!

                console.log(response.status)
                if( response.status !== 200){
                    const errorElement = document.querySelector("#form-error-message");
                    errorElement.classList.add("error-message--on");
                    errorElement.classList.add('animate__flipInX');
                    return false;
                }
                return response.json();
            })

            // On traite le json
            .then( function( json ){
                formulaire.innerHTML = "<h2 class='title-white animate__animated animate__lightSpeedInLeft'>"+json.message+"</h2>" ;
                console.log(json.message)
            })
    }

}
