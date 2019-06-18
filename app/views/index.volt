<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/bootstrap.min.css') }}
        {{ stylesheet_link('css/indexCSS.css') }}

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Exam">
        <meta name="author" content="SoviaZ Sovia Sofina">
    </head>
    <body>
        {{ content() }}
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}
        {{ javascript_include('js/utils.js') }}

    </body>
</html>
