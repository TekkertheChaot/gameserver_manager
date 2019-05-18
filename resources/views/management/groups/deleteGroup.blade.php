<?php
$groups = \App\Group::all();
?>


<style>
</style>
<div class="form-group row">
    <label for="group_id">Choose a group to delete:<br> 
    <select name="group_id" id="group_id_selector" onChange="">
     @foreach($groups as $group)
        <option value="{{$group->group_id}}">{{$group->group_name}}</option>
     @endforeach
     </select>
     </label>
</div>

<div id="submitError"></div>

<div class="float-right">
<button id="complete" class="button" onClick="onClickSubmitDeleteGroup(event)">Delete Group</button>
</div>

<script>
</script>