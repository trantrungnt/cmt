<!-- BEGIN: main -->	
		<table class="tab1">
			<tr>
				<td> CMND </td>				
				<td> Họ và tên </td>				
				<td> Ngày sinh</td>			
				<td> Giới tính </td>	
				<td> Ảnh</td>
				<td> Ảnh cỡ nhỏ</td>			
				<td> Quê quán </td>				
				<td> Nguyên quán</td>			
				<td> Nơi ĐKHKTT</td>			
				<td> Dân tộc</td>			
				<td> Tôn giáo</td>				
				<td> Ngày cấp</td>				
				<td> Nơi cấp</td>				
				<td> Đặc điểm </td>		
								
				<td></td>	
				<td></td>
			</tr>	
			
			<!-- BEGIN: loop -->							
			<tr>		
				<td>{DATA.cmnd_code}</td>			
				<td>{DATA.name}</td>				
				<td>{DATA.birthday}</td>				
				<td>{DATA.sex}</td>		
				<td> <img src="{DATA.image}" width="120" alt="Ảnh"/> </td> 
				<td> <img src="{DATA.thumb}" width="120" alt="Ảnh cỡ nhỏ"/> </td>		
				<td>{DATA.hometown}</td>			
				<td>{DATA.origin} </td>			
				<td>{DATA.place}</td>			
				<td>{DATA.ethnic}</td>				
				<td>{DATA.religious}</td>				
				<td>{DATA.date_of_issue}</td>				
				<td>{DATA.where_licensing}</td>			
				<td>{DATA.characteristics}</td>		
				<td> <a href="index.php?language=vi&nv=cmnd&op=delete_CMND&CMND_Code={DATA.cmnd_code}">Xóa</a></td>		
				<td> <a href="index.php?language=vi&nv=cmnd&op=update_CMND&CMND_Code={DATA.cmnd_code}">Sửa</a></td>				
			</tr>
			<!-- END: loop -->		
		</table>		
<!-- END: main -->


