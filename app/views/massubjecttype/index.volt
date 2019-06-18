
{{ content() }}

<div align="right">
    {{ link_to("massubjecttype/new", "เพิ่มประเภทรายวิชา", "class": "btn btn-primary") }}
</div>

{{ form("massubjecttype/search") }}

<h2>ค้นหาข้อมูลประเภทรายวิชา</h2>

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

{{ stylesheet_link('css/indexMasSubjectType.css') }}

<script type="text/javascript">
    var y = document.getElementById("SubjectTypeDetail");
    y.type= "hidden";
</script>