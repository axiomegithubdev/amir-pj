import { Controller } from '@hotwired/stimulus';

/*
 * Ce composant permet de supprimer des éléments en AJAX
 */
export default class extends Controller {
    connect() {

        //on affiche le formulaire
        console.log(this.element);

        // On va placer un "espion" sur l'élément qui va écouter le 'click' et exécuter une fonction
        this.element.addEventListener("click", this.handleClick );

    }

    // L'expion fourni à la fonction un Evènement, ici "event"
    handleClick(event){

        // ON annule le comportement par défaut de la soumission d'un formulaire
        event.preventDefault();

        // on récupère le lien
        const target = event.currentTarget
        const url = target.href;

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                //On envoie la requête AJAX
                fetch( url )

                    // On extrait le JSON de réponse
                    .then( function( response){
                        return response.json();
                    })

                    // On traite le json
                    .then( function( json ){
                        target.closest("li").remove();
                        swalWithBootstrapButtons.fire(
                            json.status+'!',
                            json.message,
                            'success'
                        )
                    })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Operation canceled :)',
                    'error'
                )
            }
        })


    }

}
