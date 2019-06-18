{{ content() }}

<ul class="pager">
    <li class="previous pull-left">
        {{ link_to("masclasslevel/index", "&larr; Go Back") }}
    </li>
    <li class="pull-right">
        {{ link_to("masclasslevel/new", "สร้างข้อมูลช่วงชั้น") }}
    </li>
</ul>

{% for masClassLevel in page.items %}



    {% if loop.first %}

<table class="table table-bordered table-striped" align="center">
    <thead>
        <tr>
{#            <th style="text-align:center">เลขที่ระดับการศึกษา</th>#}
            <th style="text-align:center">ช่วงชั้น</th>
            <th style="text-align:center">ชื่อระดับการศึกษา(ภาษาไทย)</th>
            <th style="text-align:center">ชื่อระดับการศึกษา(ภาษาอังกฤษ)</th>
{#            <th style="text-align:center">วันที่มีการเปลี่ยนแปลงล่าสุด</th>#}
        </tr>
    </thead>
{% endif %}

    <tbody>
        <tr>

            <td>{{ masClassLevel.getMasClassGroup().ClassGroupTh }}</td>
            <td>{{ masClassLevel.ClassLevelNameTh }}</td>
            <td>{{ masClassLevel.ClassLevelNameEn }}</td>

            <td width="7%">{{ link_to("masclasslevel/edit/" ~ masClassLevel.ClassLevelID, '<i class="glyphicon glyphicon-edit"></i> Edit', "class": "btn btn-default") }}</td>
            <td width="7%">{{ link_to("masclasslevel/delete/" ~ masClassLevel.ClassLevelID, '<i class="glyphicon glyphicon-remove"></i> Delete', "class": "btn btn-default") }}</td>
        </tr>
    </tbody>
{% if loop.last %}
    <tbody>
        <tr>
            <td colspan="7" align="right">
                <div class="btn-group">
                    {{ link_to("masclasslevel/search", '<i class="icon-fast-backward"></i> First', "class": "btn btn-default") }}
                    {{ link_to("masclasslevel/search?page=" ~ page.before, '<i class="icon-step-backward"></i> Previous', "class": "btn btn-default") }}
                    {{ link_to("masclasslevel/search?page=" ~ page.next, '<i class="icon-step-forward"></i> Next', "class": "btn btn-default") }}
                    {{ link_to("masclasslevel/search?page=" ~ page.last, '<i class="icon-fast-forward"></i> Last', "class": "btn btn-default") }}
                    <span class="help-inline">{{ page.current }}/{{ page.total_pages }}</span>
                </div>
            </td>
        </tr>
    <tbody>
</table>
{% endif %}
{% else %}
  ไม่พบข้อมูลระดับการศึกษา

{% endfor %}
