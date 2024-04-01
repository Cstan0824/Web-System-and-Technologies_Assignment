<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Process/search.js" defer></script>
</head>

<body>
    
    <form id="myform" method="post">
        <input  list="events" placeholder="Search Here" name="search" id="search" onkeydown="ShowResult(this.value)"/>
        <button type="submit" value="submit">Search Icon</button>
        <datalist id="events">
        </datalist>
</form>
    <table id="res">
</table>
</body>

</html>