
{{ content() }}

<div align="right">
    {{ link_to("massubjectgroup/new", "เพิ่มกลุ่มสาระวิชา", "class": "btn btn-primary") }}
</div>

{{ form("massubjectgroup/search") }}

<h2>ค้นหาข้อมูลกลุ่มสาระวิชา</h2>

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="control-group">
    {{ element.label(['class': 'control-label']) }}
    <div class="controls">
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

<div class="control-group">
    {{ submit_button("ค้นหา", "class": "btn btn-primary") }}
</div>

</fieldset>

</form>

{{ stylesheet_link('css/indexMasSubjectGroup.css') }}

<script type="text/javascript">
    var y = document.getElementById("SubjectGroupDetail");
    y.type= "hidden";
</script>