
<form id="abstracts" name="abstracts" method="post" enctype="multipart/form-data" action="abstractconf">
  <table>

    <tr>
      <td>Session</td>
      <td>
        <select name="session">
          <option value="1">Session 1</option>
          <option value="2">Session 2</option>
        </select>
      </td>
    </tr>

    <tr>
      <td>Presenting author</td>
      <td><input type="text" name="presenter" placeholder="Jerzy Neyman" size="30" /></td>
    </tr>

    <tr>
      <td>Presenter email</td>
      <td><input type="text" name="email" placeholder="jneyman@berkeley.edu" size="30" /></td>
    </tr>

    <tr>
      <td>Presenter affiliation*</td>
      <td><input type="text" name="affiliation" id="affiliation" placeholder="University of California, Berkeley" size="30" /></td>
    </tr>

    <tr>
      <td>Title</td>
      <td><input type="text" name="title" placeholder="On the Problem of the Most Efficient Tests of Statistical Hypotheses" size="30" /></td>
    </tr>

   <tr>
      <td>Full author list</td>
      <td><input type="text" name="authors" size="30" placeholder="Jerzy Neyman, Egon Pearson" /></td>
   </tr>

   <tr>
     <td valign="top">Abstract text</td>
     <td><textarea rows="5" cols="30" form="abstracts" name="abstract"
                   placeholder="The problem of testing statistical hypotheses is an old one."></textarea></td>
   </tr>

   <tr>
     <td>
       <input type="submit" name="Submit" value="Submit abstract" />
     </td>
     <td></td>
   </tr>

  </table>
  <emph class="red">LaTeX formatting is permitted for all text entry fields.</emph>
</form>

<p>
  * These affiliations names are offered as suggested spellings for
  some academic institutions. If your institution is not present, you
  may still enter it in the form.
</p>

<script>
 var institution_list = ["<?php
                               $lines = file('abstractdata/schools.txt', FILE_IGNORE_NEW_LINES);
                               echo(implode($lines, '", "'));
                               ?>"];
 $(function() {
     $("#affiliation").autocomplete({
         source: institution_list,
         messages: {
             noResults: '',
             results: function() {}
         }
     });
 });
</script>

