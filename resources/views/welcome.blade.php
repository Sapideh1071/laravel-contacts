<!doctype html>     
<html>         
    <head>             
        <meta charset="utf-8">             
        <meta name="viewport" content="width=device-width, initial-scale=1">                  
        <title>Contacts</title>             
        <link rel="stylesheet" href="https://unpkg.com/tachyons@4.10.0/css/tachyons.min.css"/>
        <script type="text/javascript" src="js/index.js"></script>         
    </head>         
    <body onload="pageloaded()">             
        <div class="mw6 center pa3 sans-serif">
            <div class="search-area">
                <input type="search" id="search-input" class="w-100" placeholder="Type name">               
                <h1 class="mb4">Contacts</h1>
                    <div id="search-area">
                    @foreach($contacts as $contact)                 
                    <div class="pa2 mb3 striped--near-white">         
                        <header class="b mb2">{{ $contact->name }}</header>
                        <div class="pl2">                         
                            <p class="mb2">{{ $contact->phone }}</p>       
                            <p class="pre mb3">{{ $contact->address }}</p>
                            <p class="mb2"><span class="fw5">Favorite colors:</span> {{ implode(', ', $contact->favorites['colors']) }}</p>                     
                        </div>                 
                    </div>                 
                @endforeach 
                </div>  
            </div>
            <div class="edit-form" style="display:none">
                <form name="edit-form">
                    <input type="hidden" name="id">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name"><br>
                    <label for="phone">Phone:</label><br>
                    <input type="text" id="phone" name="phone"><br>
                    <label for="address">Address:</label><br>
                    <input type="text" id="address" name="address"><br>
                    <label for="color">Favorite Color:</label><br>
                    <input type="text" id="color" name="color">
                    <button name="submit-button" type="button">Submit</button>
                </form>
            </div>          
        </div>         
    </body>     
</html>