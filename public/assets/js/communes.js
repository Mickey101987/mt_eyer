(function ($) {
    "use strict"
    //New item
    $('#btn-left-add-new-row, #btn-right-add-new-row').click(function () {
        showWait()
        var panelDetails = $('.panel-right')
        panelDetails.find('.grid-row-count').html('#')
        panelDetails.find('.name-span').html('New item')

        panelDetails.find('#index-tr').html('#')
        panelDetails.find('#input-id').val('')
        panelDetails.find('#input-name').val('')
        panelDetails.find('#select-type').val('')
        panelDetails.find('#input-region').val('')
        panelDetails.find('#input-department').val('')
        panelDetails.find('#input-population').val('')
        panelDetails.find('#input-description').val('')
        /* label message */
        setTimeout($('#label-message').fadeOut(), 3000)
        //Show form
        setTimeout($('#main-form').fadeIn(),4000)
        /*remove wait*/
        setTimeout(hideWait, 3000)
    })

    //Row details
    $("body").on("click", "table#data-list tbody#load-data tr", function () {
        showWait()
        $("table#data-list tbody tr").removeClass("selected");
        $(this).toggleClass("selected")

        //Get commune detail
        var id = $(this).attr('data-commune-id')
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("https://mt-eyer.herokuapp.com/api/commune/"+id, requestOptions)
            .then(response => response.text())
            .then(result => {
                var commune = JSON.parse(result)
                console.log(commune)
                var panelDetails = $('.panel-right')
                /*hydrate panel right with data*/
                panelDetails.find('.grid-row-count').html($(this).find('td:eq(0)').text())
                panelDetails.find('#index-tr').html($(this).find('td:eq(0)').text())
                panelDetails.find('.separator').html(' - ')

                panelDetails.find('.name-span').html(commune.name)
                panelDetails.find('#input-id').val(commune.id)
                panelDetails.find('#input-name').val(commune.name)
                panelDetails.find('#select-type').val(commune.type)
                panelDetails.find('#input-region').val(commune.region)
                panelDetails.find('#input-department').val(commune.department)
                panelDetails.find('#input-population').val(commune.population)
                /* label message */
                setTimeout($('#label-message').fadeOut(), 3000)

                /* Show form details */
                setTimeout($('#main-form').fadeIn(),4000)

                /*remove wait*/
                setTimeout(hideWait, 3000)

            })
            .catch(error => {
                console.log('error', error)
                /*remove wait*/
                setTimeout(hideWait, 3000)
            });
    })

    //Save
    $('#btnActionSave').click(function () {

        if ($('#input-id').val()){
            showWait()
            var id = $('#input-id').val()

            var myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

            var urlencoded = new URLSearchParams();
            urlencoded.append("name", $('#input-name').val());
            urlencoded.append("type", $('#select-type').val());
            urlencoded.append("region", $('#input-region').val());
            urlencoded.append("department", $('#input-department').val());
            urlencoded.append("population", $('#input-population').val());
            urlencoded.append("description", $('#input-description').val());

            var requestOptions = {
                method: 'PUT',
                headers: myHeaders,
                body: urlencoded,
                redirect: 'follow'
            };
            fetch("https://mt-eyer.herokuapp.com/api/commune/"+id, requestOptions)
                .then(response => response.text())
                .then(result => {
                    console.log(result)
                    hideWait()
                })
                .catch(error => {
                    console.log('error', error)
                    hideWait()
                });

        }else {
            showWait()
            var formdata = new FormData();
            formdata.append("name", $('#input-name').val());
            formdata.append("type", $('#select-type').val());
            formdata.append("region", $('#input-region').val());
            formdata.append("department", $('#input-department').val());
            formdata.append("population", $('#input-population').val());
            formdata.append("description", $('#input-description').val());

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };
            fetch("https://mt-eyer.herokuapp.com/api/commune", requestOptions)
                .then(response => response.text())
                .then(result => {
                    hideWait()
                    console.log(result)
                })
                .catch(error => {
                    console.log('error', error)
                    hideWait()
                });
        }
    })
})(jQuery)

//Load data tables
function loadData($){
    fetch('https://mt-eyer.herokuapp.com/api/communes')
        .then(response => response.json())
        .then(json => {
            //console.log(JSON.parse(json.communes))
            var communes = JSON.parse(json.communes)
            if (communes.length > 0){
                $('.pl-grid-row-count').html(communes.length)
                $('.pl-name-span').html(communes.length>1 ? 'Communes': 'Commune')
                for (var i = 0; i < communes.length; i++){
                    $('table#data-list').find(' tbody#load-data').append(
                        $('<tr>')
                            .attr('data-commune-id', communes[i].id)
                            .append(
                                $('<td>')
                                    .html('#'+ (i+1))
                            )
                            .append(
                                $('<td>')
                                    .html(communes[i].name)
                            )
                            .append(
                                $('<td>')
                                    .html(communes[i].type)
                            )
                            .append(
                                $('<td>')
                                    .html(communes[i].region)
                            )
                            .append(
                                $('<td>')
                                    .html(communes[i].department)
                            )
                            .append(
                                $('<td>')
                                    .html(communes[i].population)
                            )
                    )
                }
            }else {
                $('.pl-grid-row-count').html('Aucune')
                $('.pl-name-span').html('Commune trouver.')
            }


        })
};
