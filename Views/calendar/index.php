<div id='wrap'>

    <div id='calendar'></div>

    <div style='clear:both'></div>
</div>
<script>
    const STATUS_PLANNING = 1;
    const STATUS_DOING = 2;
    const STATUS_COMPLETE = 3;
    const STATUS_DISABLED = 0;

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    function callAjax(uri, method, data = '') {
        var result = ''
        $.ajax({
            type: method,
            url: uri,
            async: false,
            dataType: 'json',
            contentType: 'application/x-www-form-urlencoded',
            data: data,
            success: function (response) {
                result = response;
            }
        });
        return result;
    }

    function getListWorks() {
        var uri = '/?controller=work&action=getDataAsJson';
        var response = callAjax(uri, "GET");
        return response;
    }

    function getWorkById(id) {
        var uri = '/?controller=work&action=getWorkByIdAsJson&id=' + id;
        var response = callAjax(uri, "GET");
        return response;
    }

    function updateWorkById(id, data) {
        var uri = '/?controller=work&action=updateStatus&id=' + id;
        var response = callAjax(uri, "POST", data);
        return response;
    }

    function getDataForCalendar() {
        var result = [];

        var responseData = getListWorks();

        if (responseData.length > 0) {
            result = responseData.map(function (item) {
                return {
                    id: item.id,
                    title: item.work_name,
                    start: new Date(item.work_starting_date * 1000),
                };
            })
        }

        return result;
    }

    function handleClickItem(element){
        var work = getWorkById(element.id)
        if(work){
            $('.detail-work-panel').remove();

            let status = '';

            if(work.work_status == STATUS_PLANNING){
                status = 'Planning';
            }else if(work.work_status == STATUS_DOING){
                status = 'Doing';
            }else if(work.work_status == STATUS_COMPLETE){
                status = 'Compelete';
            }

            var startingDate = moment(new Date(work.work_starting_date * 1000)).format('DD/MM/YYYY, h:mm:ss');
            var endingDate = moment(new Date(work.work_ending_date * 1000)).format('DD/MM/YYYY, h:mm:ss');
            var newElement = `<div class="detail-work-panel w3-panel w3-pale-green" style="width: 400px; height: 350px; position: absolute; z-index: 1;">
            <h1>`+ work.work_name +`</h1>
            <h3>Start: `+ startingDate +`</h3>
            <h3>End: `+ endingDate +`</h3>
            <h3>Status: `+ status +`</h3>
            <h3>Change Status: </h3>
            <select onchange="handleOnchange(this)" id="`+ work.id +`">
                <option value="1">Planning</option>
                <option value="2">Doing</option>
                <option value="3">Complete</option>
            </select>
        </div>`;
            $(element).before(newElement)
        }
    }

    function handleOnchange(e){
        if(e){
            var id = e.id;
            var status = e.value;
            var data = {

                "work_status" : status
            }
            updateWorkById(id, data)
        }
    }
</script>
<script src="./public/assets/js/calendar.js"></script>
