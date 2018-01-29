


    <div class="userInfo_bx">
        <form  name="info_form">
            <div class="row_df">
                <label class="label_df">昵称</label>
                <input class="input_df" type="text" placeholder="">
            </div>

            <div class="row_df">
                <label class="label_df">姓名</label>
                <input class="input_df" type="text" placeholder="">
            </div>

            <div class="row_df">
                <label class="label_df">性别</label>
                <select class="select_sex">
                    <option style="display:none;"></option>
                    <option>男</option>
                    <option>女</option>
                </select>
            </div>

            <div class="row_df">
                <label class="label_df">生日</label>
                <select class="select_year">
                    <option style="display:none;"></option>
                    <option>1998</option>
                    <option>1999</option>
                    <option>2000</option>
                </select>
                <select class="select_month">
                    <option style="display:none;"></option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
                <select class="select_day">
                    <option style="display:none;"></option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>

            <div class="row_df">
                <label class="label_df">头像</label>
                <i class="upload_case"><img style="display:none;" src="#"/></i>
                <i class="upload_action">
                    <em class="btn_upload">
                        <input id="btn_upload_hide" type="file" placeholder="">
                        <label  class=" btn_upload_visible noneSelect" for="btn_upload_hide">上传头像</label>
                    </em>
                    <span class="txt_df">jpg或png，大小不超过2M</span>
                </i>
            </div>

            <button class="btn_submit btn_df" type="submit">保存</button>
        </form>
    </div>
</div>