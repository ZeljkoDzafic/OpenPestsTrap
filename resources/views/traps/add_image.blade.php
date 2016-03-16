@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/jquery.selectareas.css') }}">
@endsection
@section('content')

<div class="image-decorator">
    <img alt="Image principale" id="example" src="{{asset('uploads/images/'.$image->user_id.'/'.$image->image)}}"/>
</div>
<table style="margin-top: 3%">
    <tr>
        <td class="actions">
            <input type="button" class="btn btn-primary" id="btnView" value="Display areas" class="actionOn" />
            <input type="button" class="btn btn-primary"  id="btnReset" value="Reset" class="actionOn" />
        </td>
        <td>
            <div id="output" class='output'> </div>
        </td>
    </tr>
</table>

{!! Form::open(['route'=>['image_post', $image->id]]) !!}
<table id="result" style="margin-top: 3%">
    <tbody>

    </tbody>
</table>
<input hidden name="number" id="number" />
<input type="submit" style="margin-top: 3%" class="btn btn-primary" id="save"  value="Save"/>

{!! Form::close() !!}
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.selectareas.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#save').hide();

        $('img#example').selectAreas({
            onChanged: debugQtyAreas,
            width: 500,
            areas: [
            ]
        });
        $('#btnView').click(function () {
            $("#result > tbody").empty();
            $('#save').show();
            var areas = $('img#example').selectAreas('areas');
            displayAreas(areas);
        });
        $('#btnReset').click(function () {
            $('#save').hide();
            $("#result > tbody").empty();
            $('img#example').selectAreas('reset');
        });



    });

    var selectionExists;

    function areaToString (area) {
        return (typeof area.id === "undefined" ? "" : "") + "("+area.x + ',' + area.y+")   "  + ' ' + area.width + 'x' + area.height + '<br />'
    }

    function prepareArray(area)
    {
        return [area.id,area.x,area.y,area.width,area.height];
    }
    function output (text) {
        $('#output').html(text);
    }
    // Log the quantity of selections
    function debugQtyAreas (event, id, areas) {
        console.log(areas.length + " areas", arguments);
    };

    // Display areas coordinates in a div
    function displayAreas (areas) {
        var text = "";
        $.each(areas, function (id, area) {
            var r = areaToString(area);
            var arr = prepareArray(area);
            text += r;
            $("#result > tbody").append("<tr>" +
                "<td ><label class='control-label'>" + r +"</label></td>" +
                "<td>"+ "<input style='margin-left: 10%' class='form-control'  name='"+ area.id +"' type = 'text' />" + "<input name='"+ area.id +"_hidden' value='"+ arr +"' type = 'text' hidden/>"+"</td>"+
                "</tr>");
            $("#number").val(area.id);
        });
    };

</script>
@endsection