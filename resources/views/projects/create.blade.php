<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>
<body>
<div id="app" class="container mt-5">
    <h2>All Projects</h2>
    <ul>
        @foreach($projects as $project)
             <li>{{$project->name}}</li>
        @endforeach
    </ul>
    <hr>
    <h2>Create New Project</h2>
    <form action="/projects" method="post" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
        @csrf
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" name="name" v-model="form.name" placeholder="" >
            <small style="color:red;" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" v-model="form.description" placeholder="">
            <small style="color:red;" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></small>
        </div>

        <button type="submit" class="btn btn-primary" :disabled="form.errors.any()">Submit</button>
    </form>

</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
<script src="/js/app.js"></script>

</body>
</html>
