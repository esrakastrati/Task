<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Vue.js Mysql Task</title>
    <meta name="description" content="Vue.js Mysql Task" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>

    <div id="container" class="container">
        <div class="row">

            <div class="col-lg-12 bg-dark">
                <h1 class="text-light text-center display-10 pt-2 ">
                    Task - CRUD functionality
                </h1>

            </div>
        </div>

        <div class="row mt-3">

            <div class="col-lg-4 pt-3">

                Choose one category from the drop-down menu below:

                <br>
                <select class="form-select" aria-label="Default select example" v-model="currentCtg" @Change="getDocumentsList">

                    <option v-for="ctg in categories" v-bind:value="{ id: ctg.ID, text: ctg.name }">{{ctg.name}}</option>

                </select>



            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-2 mt-4 text-center justify-content-left">
                <button v-if="currentCtg.id" @click="show1=true" class="btn btn-outline-dark justify-content-right text-center bg-primary text-light">

                    <i class="bi bi-plus-circle"></i>
                    Add Document

                </button>

            </div>
        </div>

        <hr class="bg-dark">

        <div class="alert alert-danger" v-if="errorMsg">
            {{errorMsg}}
        </div>

        <div class="alert alert-success" v-if="successMsg">
            {{successMsg}}
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr class="  text-light bg-primary">
                            <th class="text-center col-md-1">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center col-md-1">Edit</th>
                            <th class="text-center col-md-1">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center" v-for="docs in documents">
                            <td>{{docs.id}}</td>
                            <td>{{docs.name}}</td>
                            <td> <a href="#" class="text-sucess" @click="show2 = true; selectDocument(docs)"><i class="bi-3x bi-wrench"></i>
                                </a> </td>
                            <td><a href="#" class="text-danger" @click="show3 = true; selectDocument(docs)"><i class="bi-3x bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>


                    </tbody>


                </table>
            </div>

        </div>

        <div class="overlay" v-if="show1" style="top: 0; bottom: 0; left: 0; right: 0; position: fixed; background: rgba(0, 0, 0, 0.6)">
            <div class="modal-dialog d-flex  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successmodalLabel">Add new document name</h5>
                        <button type="button" @click="show1=false" class="close" data-dismiss="modal" style="width: 40px">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-left clearfix">
                        <form action="#" method="post">
                            <div class="form-group ">

                                <input type="text" placeholder="name of document" v-model="newDoc.name" name="name" clas="form-control">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="show1=false; addDoc();" class="btn btn-primary">Save changes</button>
                        <button type="button" @click="show1=false" class=" btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" v-if="show2" style="top: 0; bottom: 0; left: 0; right: 0; position: fixed; background: rgba(0, 0, 0, 0.6)">
            <div class="modal-dialog d-flex  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successmodalLabel">Edit document name</h5>
                        <button type="button" @click="show2=false" class="close" data-dismiss="modal" style="width: 40px">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body d-flex justify-content-left clearfix">
                        <form action="#" method="post">
                            <div class="form-group ">
                                <input type="text" v-model="currentDoc.name" name="name" clas="form-control">

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="show2=false; editDoc()" class="btn btn-primary">Save changes</button>
                        <button type="button" @click="show2=false" class=" btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="overlay" v-if="show3" style="top: 0; bottom: 0; left: 0; right: 0; position: fixed; background: rgba(0, 0, 0, 0.6)">
            <div class="modal-dialog d-flex  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successmodalLabel">Delete document</h5>
                        <button type="button" @click="show3=false" class="close" data-dismiss="modal" style="width: 40px">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>You are deleting document with name: {{currentDoc.name}}</p>
                        <h5 class="text-danger">Are you sure you want to do this? </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="show3=false; deleteDoc()" class="btn btn-danger">Yes</button>
                        <button type="button" @click="show3=false" class=" btn btn-info" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"> </script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>


        <script src="js/server.js">

        </script>



</body>

</html>
