<?php 
require_once 'users/init.php'; 
if (!securePage($_SERVER['PHP_SELF'])){die();}

$options = array(
'submit'=>'Send', //If you want a custom submit button you must do 'submit'=>something. This doubles as the field name
'class'=>'btn btn-success',
'value'=>'Send',
);

if(!empty($_POST)){
	$response = preProcessForm();
	if($response['form_valid'] == true){
		$message = $response['fields']['message'];
		
		// exec python classify
		//exec('python disasterclassify.py --message "' + $message + '"');
		
		// send to db
		postProcessForm($response);
		
		Redirect::to('index.php?err=Success!');
	}
}
	
	

$db = DB::getInstance();

?>
<!doctype html>
<html lang="en">
    <head>    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Disaster Response Project </title>
        <link rel="shortcut icon" href="{{ url_for('static', filename='favicon.ico') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="https://github.com/sanjeevai/disaster-response-pipeline" target="_blank" style="color:white;">Disaster Response Project</a>
                </div>
                <div class="collapse navbar-collapse ml-auto" id="navbar" >
                    <ul class="nav navbar-nav">
                        <li><a href="https://www.udacity.com/" target="_blank" style="color:white;">Made with Udacity</a></li>
                        <li><a href="https://github.com/sanjeevai/" target="_blank" style="color:white;">GitHub</a></li>
                        <li><a href="mailto:sanjeev.yadav.ai@outlook.com" target="_top" style="color:white;">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="jumbotron">
            <div class="container">
                <h1 class="text-center">Disaster Response Project</h1>
                <p class="text-center">Analyzing message data for disaster response</p>
                <hr />
            
                <div class="row">
                    <div class="col-lg-12 form-group-lg">
						<?php displayForm('helpform2', $options);	?>
                        <form action="/go" method="get">    
                            <input type="text" class="form-control form-control-lg" name="query" placeholder="Enter a message to classify">
                            <div class="col-lg-offset-5">
                                <button type="submit" class="btn btn-lg btn-success">Classify Message</button>
                            </div>
                        </form>
                    </div>
                </div>

                {% block message %}
                {% endblock %}
            </div>
        </div>

        <div class="container">
            {% block content %}
                <div class="page-header">
                    <h1 class="text-center">Overview of Training Dataset</h1>
                </div>
            {% endblock %}

            {% for id in ids %}
            <div id="{{id}}"></div>
            {% endfor %}

        </div>

        <script type="text/javascript">
            // plots the figure with id
            // id must match with the div id above in the html
            var figures = {{figuresJSON | safe}};
            var ids = {{ids | safe}};
            for(var i in figures) {
                Plotly.plot(ids[i],
                            figures[i].data,
                            figures[i].layout || {});
            }
        </script>

    </body>
</html>