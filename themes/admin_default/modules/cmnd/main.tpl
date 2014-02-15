<!-- BEGIN: main -->
	<form action="{NV_BASE_ADMINURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&amp;{NV_NAME_VARIABLE}={MODULE_NAME}&amp;{NV_OP_VARIABLE}={OP}" method="post" enctype="multipart/form-data">
		<div style="text-align: center"><input name="submit" type="submit" value="Thêm mới" /></div>
		
		<table width="500">
			<tr>
				<td> Mã Chứng minh thư nhân dân</td>
				<td> <input type="text" name="CMND"/> </td>				
			</tr> 
			
			<tr>
				<td> Họ và tên</td>
				<td> <input type="text" name="name"/></td>
			</tr>
			
			<tr>
				<td> Ngày sinh</td>
				<td> <input type="text" name="birthday"/></td>
			</tr>
			
			<tr>
				<td> Ảnh đại diện</td>
				<td> <input type="file" name="avatar"></td>
			</tr>
			
			<tr>
				<td> Giới tính</td>
				
				<td> 	
					<input type="radio" name="sex" value="1" checked="true">Nam<br/>
	 		 		<input type="radio" name="sex" value="0">Nữ
	 		 	</td>
			</tr>
			
			<tr>
				<td> Quê quán </td>
				<td> <input type="text" name="hometown" /></td>
			</tr>
			
			<tr>
				<td> Nguyên quán</td>
				<td> <input type="text" name="origin"/></td>
			</tr>
			
			<tr>
				<td> Nơi đăng ký hộ khẩu thường trú</td>
				<td> <input type="text" name="place" /></td>
			</tr>
			
			<tr>
				<td> Dân tộc</td>
				<td> <input type="text" name="ethnic" /></td>
			</tr>
			
			<tr>
				<td> Tôn giáo</td>
				<td> <input type="text" name="religious" /> </td>
			</tr>
			
			<tr>
				<td> Ngày cấp</td>
				<td><input type="text" name="date_of_issue" /></td>
			</tr>
			
			<tr>
				<td> Nơi cấp</td>
				<td> <input type="text" name="where_licensing" /></td>
			</tr>
			
			<tr>
				<td> Đặc điểm</td>
				<td> <input type="text" name="characteristics" /></td>
			</tr>
		</table>
	</form>
<!-- END: main -->
