<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vitl Test page</title>
    <script>
        function fetchResults()
        {
            // Get form fields (including CSRF)
            var form_terms = document.getElementsByClassName("ajax_terms");
            var form_dupes = document.getElementsByClassName("ajax_dupes");
            var csrf_token = document.getElementsByClassName("csrf_token");
4
            // remove whitespace
            var terms = form_terms[0].value.replace(/\s/g, '');

            // Create form data
            var formData = new FormData();
            formData.append('terms', terms);
            formData.append('dupes', form_dupes[0].checked);
            formData.append('_token', csrf_token[0].value);

            // Prep Ajax call/data
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function()
            {
                // Was it a clean result (Including an expected error)?
                if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
                {
                    var search_results = JSON.parse(xmlHttp.responseText);

                    if (search_results.errors != null) {
                        document.getElementById('errors').innerHTML = search_results.errors
                    }
                    var results = search_results.results;
                    var num_results = Object.keys(results).length;
                    if (num_results > 0) {
                        var resultsDIV = document.getElementById('show_results');
                        var filtered_text = (form_dupes[0].checked) ? ' de-duplicated' : ' total ';

                        resultsDIV.innerHTML = 'There are ' + num_results + filtered_text +' results <p />';
                        for (var i = 0; i < num_results; i++) {
                            resultsDIV.innerHTML += results[i]['name_last'] + ' ' + results[i]['name_first'] + '<br />';
                        }
                    } else {
                        document.getElementById('errors').innerHTML = 'There are 0 results';
                    }
                }
            }
            xmlHttp.open("post", "<?php echo e(url('/fetchUserData')); ?>");
            xmlHttp.send(formData);
        }
    </script>
<style>
    .errors {
        color: white;
        background-color: red;
    }
</style>
</head>
<body>

    <div id="search_box">
        <input type="hidden" name="_token" id="token" class="csrf_token" value="<?php echo e(csrf_token()); ?>">
        <input type="test" name="terms" class="ajax_terms" placeholder="name to search"  /><br />
        <label for="dupes">Ignore duplicates</label>
            <input type="checkbox" name="dupes" class="ajax_dupes" value="1" /><br />
        <input type="button" value="SEARCH" onclick="fetchResults()" />
    </div>

<hr />

<div id="show_results">
    <div id="errors" class="errors"></div>

</div>

</body>
</html>

<?php /**PATH D:\web\vitl\vitl\resources\views/search.blade.php ENDPATH**/ ?>