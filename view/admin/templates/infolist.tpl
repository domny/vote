
{include file="../../includes/header.tpl"}


            <ul class="tabbar">
                <li><a title="" href="admin">��ҳ</a></li>
                <li><a title="" href="itemlist">ͶƱ��Ŀ</a></li>
                <li class="selected"><a title="" href="infolist">ͶƱ��¼</a></li>
            </ul>



            <table>
                <thead>
                <th width="185px">ͶƱ��</th>
                <th>ͶƱʱ��<i class="J_CreateTime down-order" data-value="sort=publishTime_down"><s
                        class="current"></s></i></th>
                <th>��Ŀ���</th>
                <th>��Ŀ����</th>
                <th>״̬</th>
                <th>��ע</th>

                </thead>
                <tbody>

                 {foreach from=$items item=item}
                    <tr>
                        <td>{$item.nick}</td>
                        <td>{$item.gmt_create}</td>
                        <td>{$item.item_id}</td>
                        <td>{$item.name}</td>
                        <td>{$item.status}</td>
                        <td>{$item.memo}</td>
                   </tr>
                {/foreach}

                </tbody>
            </table>


{include file="../../includes/footer.tpl"}