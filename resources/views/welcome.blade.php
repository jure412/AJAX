<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <!-- Styles -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style>
            .model, .model-edit {
                position: fixed;
                left: 50%;
                right: 50%;
                bottom: 50%;
                transform: translate(-50%, 50%);
                border: 2px solid black;
                width: 300px;
                border-radius: 10%;
                background: aquamarine;
                display: none;
                grid-template-areas:
                'text'
                'check'
                'stars'
                'range'
                'click'
                'list'
                'butto'
                ;
                grid-template-columns: 1fr;
                grid-template-rows: 30px 60px 40px 55px 30px 1fr 70px;
                padding: 15px;
            }

            .text {
                grid-area: text;
                border: none;
                background: transparent;
                border-bottom: 1px solid black
            }
            .text:focus {
                outline: none;
            }



            /* --------------------------checkbox custom button----------------------------- */

            .checkbox {
                grid-area: check;
                position: relative;
                display: block;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                cursor: pointer;
                font-size: 22px;
            }

            .checkbox .check {
                position: absolute;
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .checkbox .checkmark {
                position: absolute;
                top: 50%;
                transform: translate(-50% 50%);
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #d3d3d3;
                opacity: 0.7;
            }

            .checkbox:hover .check ~ .checkmark {
                background-color: grey;
            }

            .checkbox input:checked ~ .checkmark {
                background-color: grey;
                opacity: 1;
            }

            .checkbox .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .checkbox .check:checked ~ .checkmark:after {
                display: block;
            }

            .checkbox .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            .checkbox .label {
                position: absolute;
                top: 50%;
                transform: translate(-50% 50%);
                left: 30px;
            }

            /* ----------------------------------5 stars rating custom---------------------------------- */

            .rating {
                grid-area: stars;
                justify-self: left;
            }

            .rating:not(:checked) > input {
                position:absolute;
                top:-9999px;
                clip:rect(0,0,0,0);
            }

            .rating:not(:checked) > label {
                float: right;
                width:1em;
                padding:0 .1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:200%;
                line-height:1.2;
                color:#ddd;
            }
            .rating:not(:checked) > label:before {
                content: '★ ';
                /* color: black; */
            }

            .rating > input:checked ~ label {
                color: gold;
            }

            .rating:not(:checked) > label:hover,
            .rating:not(:checked) > label:hover ~ label {
                color: goldenrod;
            }

            .rating > input:checked + label:hover,
            .rating > input:checked + label:hover ~ label,
            .rating > input:checked ~ label:hover,
            .rating > input:checked ~ label:hover ~ label,
            .rating > label:hover ~ input:checked ~ label {
                color: #ea0;
            }




            /* ----------------------------------range custom---------------------------------- */

            .slidecontainer {
                grid-area: range;
                width: 100%;
            }

            .slider {
                -webkit-appearance: none;
                width: 100%;
                height: 10px;
                border-radius: 5px;
                background: #d3d3d3;
                outline: none;
                /* opacity: 0.7; */
                -webkit-transition: .2s;
                transition: opacity .2s;
            }
            .slider:hover {
                opacity: 1;
            }

            .slider::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 23px;
                height: 24px;
                border: 0;
                background-image: url('http://127.0.0.1:8000/image/smile.png');
                background-size: cover;
                background-position: center;
                cursor: pointer;
                opacity: 1;
            }

            .slider::-moz-range-thumb {
                width: 23px;
                height: 24px;
                border: 0;
                background-image: url('/public/image/smile.png');
                background-size: cover;
                background-position: center;
                cursor: pointer;
                opacity: 1;
            }

            /* ----------------------------------select custom---------------------------------- */

            .select-box {
                grid-area: click;
                height: 30px;
                line-height: 30px;
                background: grey;
                text-align: center;
                box-shadow: inset 0.5px .5px 0.3pc black;
                align-self: flex-end;
                cursor: pointer;
            }

            .list {
                grid-area: list;
                width: 100%;
                display: none;
                overflow: auto;
                background: darkgray;
                z-index: 1;
            }

            .list label {
                width: 100%;
                background: darkgray;
                position: relative;

            }

            .list label .check {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .list label .checkmark {
                position: absolute;
                left: 3px;
                top: 20%;
                transform: translate(50% -50%);
                width: 15px;
                height: 15px;
                background: whitesmoke;
            }

            .list label .label {
                margin-left: 25px;
            }

            .list label input:checked ~ .checkmark {
                background-color: grey;
                opacity: 1;
            }

            .list label .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            .list label .check:checked ~ .checkmark:after {
                display: block;
            }

            .list label .checkmark:after {
                left: 6px;
                top: 3px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }

             .button {
                grid-area: butto;
                border: none;
                margin: 20px auto;
                width: 60%;
                box-shadow: inset 1px 1px 1pc black,
                            1px 1px black,
                            2px 2px black,
                            3px 3px black;
                background: yellowgreen;
            }

            button:focus {
                outline: none;
                transform: translate(3px, 3px);
                box-shadow: inset 1px 1px 1pc black;
            }

        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row m-5">
                <button class="btn btn-primary" onclick="createModal();">Click</button>
            </div>
            <form class="model" id="modal">
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                <input type="text" class="text" name="name">
                <label class="checkbox">
                    <input type="checkbox" class="check" id="check" value="" name="check">
                    <span class="checkmark"></span><span class="label">Are you ok?</span>
                </label>
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
                    <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
                    <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
                    <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
                    <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
                </fieldset>
                <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" name="range" id="range" onchange="inputValue();" class="slider" >
                    <p>Value: <span id="demo"></span></p>
                </div>
                <div class="select-box" onclick='listDropdown("list");'>
                    click !
                </div>
                <div class="list" id="list">
                    @foreach ($types as $type)
                    <label>
                        <input type="checkbox" class="check" id="checkbox" name="checkbox" value="{{$type->id}}" >
                        <span class="checkmark"></span>
                        <span class="label">{{ $type->type }}</span>
                    </label>
                    @endforeach
                </div>
                {{-- <button type="submit" id="button" class="button">Add</button> --}}
                <button class="button">Add</button>
            </form>

            {{-- <form class="model" id="modal-edit">
            </form> --}}
            {{-- ------------------------------------modal edit------------------------------------ --}}
            <form class="model-edit" id="modal-edit">

            </form>

            <div class="row">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Robot</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Age</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        @foreach ($people as $person)
                        <tr class="post">
                            <td>{{ $person->id }}</td>
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->robot }}</td>
                            <td>{{ $person->rating }}</td>
                            <td>{{ $person->age }}</td>
                            <td >
                                <span><a class="btn btn-warning"  onclick="editModal({{$person->id}});">Edit</a></span>
                                <span>
                                    <form class="delete" id="delete-{{ $person->id }}">
                                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-danger delete-button" onclick="return confirmDelete({{$person->id}})">Delete</button>
                                    </form>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <script>
        function listDropdown(element) {
            const list = document.getElementById(element);
            if(list.style.display == 'grid') {
                list.style.display = 'none';
            } else {
                list.style.display = 'grid';
            }
        }

        function createModal() {
            const list = document.getElementById('modal');
            if(list.style.display == 'grid') {
                list.style.display = 'none';
            } else {
                list.style.display = 'grid';
                let ratings_create = document.getElementsByName('rating');
                ratings_create[2].checked = true;
                list.addEventListener("submit", post);
                list.reset();
            }
        }

        function editModal(id, token) {
            const list = document.getElementById('modal-edit');
            if(list.style.display == 'grid') {
                list.style.display = 'none';
            } else {
                list.style.display = 'grid';
                edit(id);

            }
        }

        document.getElementById('modal-edit').addEventListener("submit", function() {
                update();
                document.getElementById('modal-edit').style.display = 'none';
            }, false);



        function del(id) {
            event.preventDefault();
            let token = document.getElementById('_token').value;

            let data = {
                    "_token": token,
            };

			var http = new XMLHttpRequest();

			http.open('PUT', 'http://127.0.0.1:8000/welcome/delete/'+id, true);

			http.onload = function(){
                if (this.readyState == 4 && this.status == 200) {
				    let rows = JSON.parse(this.response);
                        let output = '';
                        for(let i = 0; i < rows.length; i++) {
                            output +=
                            '<tr>' +
                                '<td>'+rows[i].id+'</td>' +
                                '<td>'+rows[i].name+'</td>' +
                                '<td>'+rows[i].robot+'</td>' +
                                '<td>'+rows[i].rating+'</td>' +
                                '<td>'+rows[i].age+'</td>' +
                                '<td>' +
                                '<span><button class="btn btn-warning" onclick="editModal('+rows[i].id+')">Edit</button></span>' +
                                '<span>' +
                                    '<form class="delete" id="delete-'+rows[i].id+'">' +
                                        '<input type="hidden" id="_token" value="{{ csrf_token() }}">' +
                                        '<button class="btn btn-danger delete-button" onclick="return confirmDelete('+rows[i].id+')">Delete</button>' +
                                    '</form>' +
                                '</span>' +
                                '</td>' +
                            '</tr>'
                        }
                        const table = document.getElementById('table');
                        // console.log(table);
                        table.innerHTML = output;
                }

			}
            http.setRequestHeader('Content-Type', 'application/json');
			http.send(JSON.stringify(data));
        }

        function update() {
            event.preventDefault();
            let id_edit = document.getElementsByName('id-edit')[0].value;
            let name_edit = document.getElementsByName('name-edit')[0];
            let robot_edit = document.getElementsByName('check-edit')[0];
            let age_edit = document.getElementsByName('range-edit')[0];
            const token = document.getElementById('token').value;
            let type_edit = document.getElementsByName('checkbox-edit');
            // console.log(type_edit);
            let types = [];
                type_edit.forEach(element => {
                    if(element.checked == true) {
                        types.push(element.value);
                    }
                });
                // console.log(types);
            var http = new XMLHttpRequest();
                let data = {
                    "_token": token,
                    "id": id_edit,
                    "name" : name_edit.value,
                    "types" : types,
                    "check" : robot_edit.checked,
                    "age" : age_edit.value,
                };
                http.onload = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        let rows = JSON.parse(this.response);
                        let output = '';
                        // console.log(rows);
                        for(let i = 0; i < rows.length; i++) {
                            output +=
                            '<tr>' +
                                '<td>'+rows[i].id+'</td>' +
                                '<td>'+rows[i].name+'</td>' +
                                '<td>'+rows[i].robot+'</td>' +
                                '<td>'+rows[i].rating+'</td>' +
                                '<td>'+rows[i].age+'</td>' +
                                '<td>' +
                                '<span><button class="btn btn-warning" onclick="editModal('+rows[i].id+')">Edit</button></span>' +
                                '<span>' +
                                    '<form class="delete" id="delete-'+rows[i].id+'">' +
                                        '<input type="hidden" id="_token" value="{{ csrf_token() }}">' +
                                        '<button class="btn btn-danger delete-button" onclick="return confirmDelete('+rows[i].id+')">Delete</button>' +
                                    '</form>' +
                                '</span>' +
                                '</td>' +
                            '</tr>'
                        }
                        const table = document.getElementById('table');
                        table.innerHTML = output;
                    }
                };
                http.open('PUT', 'welcome/'+id_edit, true);
                http.setRequestHeader('Content-Type', 'application/json');
                http.send(JSON.stringify(data));
        }

        function edit(id) {
            var params = {

                    "id": id,
            };


			var http = new XMLHttpRequest();

			http.open('GET','welcome/'+id+'/edit',true);



			http.onload = function(){
                let rows = JSON.parse(http.response);
				let editModal = document.getElementById('modal-edit');

                let checked = "";
                if(rows['person'].robot == 1) {
                    checked = "checked";
                }
                let range = rows['person'].age;
                let selected = rows['selected'];
                let select = [];
                selected.forEach(e => {
                        select.push(e.type_id);

                    });


                let output = '';


                rows['types'].forEach(element => {
                    let checked_type = '';
                    if(select.includes(element.id)) {
                        checked_type = 'checked';
                    }
                    output +=
                        '<label>' +
                            '<input type="checkbox" class="check" id="checkbox" '+checked_type+'  name="checkbox-edit" value="'+element.id+'" >' +
                            '<span class="checkmark"></span>' +
                            '<span class="label">'+element.type+'</span>' +
                        '</label>'
                });
                editModal.innerHTML =
                '<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">'+
                '<input type="hidden" id="id-edit" name="id-edit" value="'+ rows['person'].id +'">'+
                '<input type="text" class="text" name="name-edit" value="'+ rows['person'].name +'">' +
                '<label class="checkbox">' +
                    '<input type="checkbox" class="check" id="check-edit" '+checked+' name="check-edit">' +
                    '<span class="checkmark"></span><span class="label">Are you ok?</span>' +
                '</label>' +
                '<fieldset class="rating">' +
                    '<input type="radio" id="star5" name="rating-edit" value="5" /><label for="star5" title="Rocks!">5 stars</label>' +
                    '<input type="radio" id="star4" name="rating-edit"  value="4" /><label for="star4" title="Pretty good">4 stars</label>' +
                    '<input type="radio" id="star3" name="rating-edit"  value="3" /><label for="star3" title="Meh">3 stars</label>' +
                    '<input type="radio" id="star2" name="rating-edit" value="2" /><label for="star2" title="Kinda bad">2 stars</label>' +
                    '<input type="radio" id="star1" name="rating-edit" value="1" /><label for="star1" title="Sucks big time">1 star</label>' +
                '</fieldset>' +
                '<div class="slidecontainer">' +
                    '<input type="range" min="1" max="100" value="'+range+'" name="range-edit" id="range-edit" onchange="inputValue();" class="slider" >' +
                    '<p>Value: <span id="demo-edit">'+range+'</span></p>' +
                '</div>' +
                '<div class="select-box" onclick='+"listDropdown('list-edit');"+'>' +
                    'click !' +
                '</div>' +
                '<div class="list" id="list-edit">' +
                    output +
                '</div>' +
                '<button class="button">Add</button>'
                ;

			}

			http.send(JSON.stringify(params));


        }



        function post(event){
            event.preventDefault();

            let name_create = document.getElementsByName('name')[0];
            let robot_create = document.getElementsByName('check')[0];
            let ratings_create = document.getElementsByName('rating');
            let age_create = document.getElementsByName('range')[0];
            let type_create = document.getElementsByName('checkbox');


                let type = [];
                type_create.forEach(element => {
                    if(element.checked == true) {
                        type.push(element.value);
                    }
                });


                ratings_create.forEach(element => {
                        if(element.checked == true) {
                            rating = element.value;
                        }
                    });
                const token = document.getElementById('token').value;
                var http = new XMLHttpRequest();
                    let data = {
                        "_token": token,
                        "name" : name_create.value,
                        "check" : robot_create.checked,
                        "types" : type,
                        "rating" : rating,
                        "age" : age_create.value,
                    };
                    http.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {

                            let rows = JSON.parse(this.response);

                            let output = '';
                            for(let i = 0; i < rows.length; i++) {
                                output +=
                                '<tr>' +
                                    '<td>'+rows[i].id+'</td>' +
                                    '<td>'+rows[i].name+'</td>' +
                                    '<td>'+rows[i].robot+'</td>' +
                                    '<td>'+rows[i].rating+'</td>' +
                                    '<td>'+rows[i].age+'</td>' +
                                    '<td>' +
                                    '<span><button class="btn btn-warning" onclick="editModal('+rows[i].id+')">Edit</button></span>' +
                                    '<span>' +
                                        '<form class="delete" id="delete-'+rows[i].id+'">' +
                                        '<input type="hidden" id="_token" value="{{ csrf_token() }}">' +
                                        '<button class="btn btn-danger delete-button" onclick="return confirmDelete('+rows[i].id+')">Delete</button>' +
                                        '</form>' +
                                    '</span>' +
                                    '</td>' +
                                '</tr>'
                            }
                            table.innerHTML = output;
                        }
                    };
                    http.open('POST', "{{ route('welcome.store') }}", true);
                    http.setRequestHeader('Content-Type', 'application/json');
                    http.send(JSON.stringify(data));
                    document.getElementById('modal').style.display = 'none';
                    // window.location.reload();
        }

        // ------------------------ ///AJAX FORM------------------------ ///
        function inputValue() {
            value = document.getElementById('range').value;
            valueEdit = document.getElementById('range-edit').value;
            document.getElementById('demo').innerHTML = value;
            document.getElementById('demo-edit').innerHTML = valueEdit;

        }
        function confirmDelete(id)
        {
            var x = confirm("Are you sure you want to delete?");
            if (x) {
                del(id);
                return true;
            }
            else {
                return false;
            }
        }

    </script>
    </body>
</html>
