var app = new Vue({
    el: '#container',
    data: {
        errorMsg: "",
        successMsg: "",
        show1: false, // boolean variable for CreateForm
        show2: false, // boolean variable for CreateForm 
        show3: false, // boolean variable for CreateForm
        documents: [],
        categories: [],
        currentCtg: {
            id: "",
        },
        newDoc: {
            name: "",
            cat_id: ""
        },
        currentDoc: {
            name: "",
            cat_id: ""
        },

    },

    mounted: function () {
        //this.getDocuments();
        this.getCategory();
    },

    methods: {
        getDocuments() {
            axios.get("http://localhost/Task-main/model/proccess.php?action=read").then(function (response) {
                if (response.data.error) {
                    app.errorMsg = response.data.message;
                } else {
                    app.documents = response.data.docs;
                }
            })
        },
        getDocumentsList() {
            var formData = app.toFD(app.currentCtg);
            axios.post("http://localhost/Task-main/model/proccess.php?action=readList", formData).then(function (response) {
                if (response.data.error) {
                    app.errorMsg = response.data.message;
                } else {
                    app.documents = response.data.docs;


                }
            })
        },
        getCategory() {
            axios.get("http://localhost/Task-main/model/proccess.php?action=read").then(function (response) {
                if (response.data.error) {
                    app.errorMsg = response.data.message;
                } else {
                    app.categories = response.data.ctg;
                }
            })
        },

        addDoc() {
            app.newDoc.cat_id = app.currentCtg.id;
            var formData = app.toFD(app.newDoc);
            axios.post("http://localhost/Task-main/model/proccess.php?action=create", formData).then(function (response) {

                if (response.data.error) {
                    app.errorMsg = response.data.error;
                    setTimeout(() => { app.updateMessages() }, 2000);

                } else {
                    app.successMsg = response.data.message;
                    app.getDocumentsList();
                    setTimeout(() => { app.updateMessages() }, 2000);
                }
            })
        },


        editDoc() {
            app.currentDoc.cat_id = app.currentCtg.id;
            var formData = app.toFD(app.currentDoc);
            axios.post("http://localhost/Task-main/model/proccess.php?action=update", formData).then(function (response) {

                if (response.data.error) {
                    app.errorMsg = response.data.error;
                    setTimeout(() => { app.updateMessages() }, 2000);

                } else {
                    app.successMsg = response.data.message;
                    app.getDocumentsList();
                    setTimeout(() => { app.updateMessages() }, 2000);


                }
            })
        },

        deleteDoc() {
            app.currentDoc.cat_id = app.currentCtg.id;
            var formData = app.toFD(app.currentDoc);
            axios.post("http://localhost/Task-main/model/proccess.php?action=delete", formData).then(function (response) {

                if (response.data.error) {
                    app.errorMsg = response.data.error;
                    setTimeout(() => { app.updateMessages() }, 2000);

                } else {
                    app.successMsg = response.data.message;
                    app.getDocumentsList();
                    setTimeout(() => { app.updateMessages() }, 2000);

                }
            })
        },

        toFD(obj) {
            var fd = new FormData();
            for (var i in obj) {
                fd.append(i, obj[i]);
            }
            return fd;

        },
        selectDocument(doc) {
            app.currentDoc = doc;
        },
        updateMessages() {
            app.successMsg = "";
            app.errorMsg = "";

        }
    }
})
