
{{ form("schoolstudent/save", 'role': 'form') }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("schoolstudent", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ submit_button("Save", "class": "btn btn-success") }}
    </li>
</ul>

{{ content() }}
{#        {{ stylesheet_link('css/indexSchoolStudentNew.css') }}#}

<h2>แก้ไขข้อมูลนักเรียน</h2>

<fieldset>

{% for element in form %}
    {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
{{ element }}
    {% else %}
<div class="form-group">
    {{ element.label(['class': 'control-label']) }}
    <div class="controls">
        {{ element }}
    </div>
</div>
    {% endif %}
{% endfor %}

</fieldset>

</form>
{{ javascript_include('js/schoolstudentEdit.js') }}
