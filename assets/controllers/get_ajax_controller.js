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
        // On cible l'élément en cours et on change son contenu texte
        this.element.textContent = 'Test JSON';

        // On va placer un "espion" sur l'élément qui va écouter le 'click' et exécuter une fonction
        this.element.addEventListener("click", this.handleClick )

    }

    // L'expion fourni à la fonction un Evènement, ici "event"
    handleClick(event){

        // on affiche la cible de l'évènement
        console.log(event.target);

        // On récupère la valeur de l'attribut "data-url" qui est sur notre balise
        const url = event.target.dataset.url;

        fetch( url )
            .then( function( response){
                return response.json()
            })
            .then( function( json ){
                console.log(json.message)
            })


    }

}
