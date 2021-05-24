(function ($) {
    "use strict"
    //New item
    $('#btn-left-add-new-row, #btn-right-add-new-row').click(function () {
        showWait()
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };
        fetch('http://localhost:8080/api/communes', requestOptions)
            .then(response => response.json())
            .then(json => {
                var communes = JSON.parse(json.communes)
                if (communes.length > 0) {
                    for (var i = 0; i < communes.length; i++){
                        $('#select-commune').append(
                            $('<option>')
                                .attr('value', communes[i].id)
                                .html(communes[i].name)
                        )
                    }
                }
            })
            .catch(error => {
                console.log('error', error)
            })
        var panelDetails = $('.panel-right')
        panelDetails.find('.grid-row-count').html('#')
        panelDetails.find('.name-span').html('New item')
        panelDetails.find('.separator').html(' - ')

        panelDetails.find('#index-tr').html('#')
        panelDetails.find('#input-id').val('')
        panelDetails.find('#input-name').val('')
        panelDetails.find('#select-commune').val('')
        panelDetails.find('#input-identification-number').val('')
        panelDetails.find('#input-last-name').val('')
        panelDetails.find('#input-phone-number').val('')
        panelDetails.find('#input-neighborhood').val('')
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
        var requestOption = {
            method: 'GET',
            redirect: 'follow'
        };
        fetch('http://localhost:8080/api/communes', requestOption)
            .then(response => response.json())
            .then(json => {
                var communes = JSON.parse(json.communes)
                if (communes.length > 0) {
                    for (var i = 0; i < communes.length; i++){
                        $('#select-commune').append(
                            $('<option>')
                                .attr('value', communes[i].id)
                                .html(communes[i].name)
                        )
                    }
                }
            })
            .catch(error => {
                console.log('error', error)
            })
        $("table#data-list tbody tr").removeClass("selected");
        $(this).toggleClass("selected")

        //Get taximan detail
        var id = $(this).attr('data-taximan-id')
        var requestOptions = {
            method: 'GET',
            redirect: 'follow'
        };

        fetch("http://localhost:8080/api/taximan/"+id, requestOptions)
            .then(response => response.text())
            .then(result => {
                var taximan = JSON.parse(result)
                console.log(taximan)
                var panelDetails = $('.panel-right')
                /*hydrate panel right with data*/
                panelDetails.find('.grid-row-count').html($(this).find('td:eq(0)').text())
                panelDetails.find('#index-tr').html($(this).find('td:eq(0)').text())
                panelDetails.find('.separator').html(' - ')

                panelDetails.find('.name-span').html(taximan.first_name+' '+taximan.last_name)
                panelDetails.find('#input-id').val(taximan.id)
                panelDetails.find('#input-name').val(taximan.first_name)
                panelDetails.find('#select-commune').val(taximan.commune_of)
                panelDetails.find('#input-identification-number').val(taximan.identification_number)
                panelDetails.find('#input-last-name').val(taximan.last_name)
                panelDetails.find('#input-phone-number').val(taximan.phone_number)
                panelDetails.find('#input-neighborhood').val(taximan.neighborhood)
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
            urlencoded.append("commune_of", $('#select-commune').val());
            urlencoded.append("identification_number", $('#input-identification-number').val());
            urlencoded.append("first_name", $('#input-name').val());
            urlencoded.append("last_name", $('#input-last-name').val());
            urlencoded.append("phone_number", $('#input-phone-number').val());
            urlencoded.append("neighborhood", $('#input-neighborhood').val());

            var requestOptions = {
                method: 'PUT',
                headers: myHeaders,
                body: urlencoded,
                redirect: 'follow'
            };
            fetch("http://localhost:8080/api/taximan/"+id, requestOptions)
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
            formdata.append("commune_of", $('#select-commune').val());
            formdata.append("identification_number", $('#input-identification-number').val());
            formdata.append("first_name", $('#input-name').val());
            formdata.append("last_name", $('#input-last-name').val());
            formdata.append("phone_number", $('#input-phone-number').val());
            formdata.append("neighborhood", $('#input-neighborhood').val());

            var requestOptions = {
                method: 'POST',
                body: formdata,
                redirect: 'follow'
            };
            fetch("http://localhost:8080/api/taximan", requestOptions)
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
    fetch('http://localhost:8080/api/taximen')
        .then(response => response.json())
        .then(json => {
            //console.log(JSON.parse(json.taximen))
            var taximen = JSON.parse(json.taximen)
            if (taximen.length > 0){
                //Hide empty error
                $('.label-message-empty-table').fadeOut()

                $('.pl-grid-row-count').html(taximen.length)
                $('.pl-name-span').html(taximen.length>1 ? 'Taximen': 'Taximan')
                for (var i = 0; i < taximen.length; i++){
                    $('table#data-list').find(' tbody#load-data').append(
                        $('<tr>')
                            .attr('data-taximan-id', taximen[i].id)
                            .append(
                                $('<td>')
                                    .html('#'+ (i+1))
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].identification_number)
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].first_name+' '+taximen[i].last_name)
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].phone_number)
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].neighborhood)
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].vest_number)
                            )
                            .append(
                                $('<td>')
                                    .html(taximen[i].owner === 1 ? 'oui' : 'non')
                            )

                    )
                }
            }else {
                $('.pl-grid-row-count').html('Aucun')
                $('.pl-name-span').html('taximan trouver.')
            }


        })
};
