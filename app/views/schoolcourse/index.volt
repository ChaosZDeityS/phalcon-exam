
{{ content() }}

<div align="right">
    {{ link_to("schoolcourse/new", "เพิ่มคำนำหน้าชื่อ", "class": "btn btn-primary") }}
</div>

{{ form("schoolcourse/search") }}

<h2>ค้นหาข้อมูลหลักสูตร</h2>

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

{{ stylesheet_link('css/indexSchoolCourse.css') }}

<script type="text/javascript">
    var y = document.getElementById("CourseDetail");
    y.type= "hidden";
</script>