<form action="user/user_add.php" method="post">
          <div class="form-group">
            <label>Tên Phòng Ban:</label>
            <input type="text" name="display_name" class="form-control" placeholder="Bạn cần nhập thông tin"
              required="" />
          </div>
          <div class="form-group">
            <label>Mã Phòng Ban</label>
            <input type="text" name="name" class="form-control" placeholder="Bạn cần nhập thông tin" required="" />
          </div>

          <div class="form-group">
            <label>Khối:</label>
            <br />
            <select class="custom-select" name="block" value="SX">
              <option selected value="SX">Sản Xuất</option>
              <option value="KD">Kinh Doanh</option>
              <option value="KT">Kỹ Thuật</option>
              <option value="NC">Nội Chính</option>
              <option value="KT">Kế Toán</option>
            </select>
          </div>
          <div class="form-group">
            <label>Ghi chú:</label>
            <textarea class="form-control" aria-label="With textarea" name="issue" required=""></textarea>
          </div>

          <input type="submit" class="btn btn-block btn-info" value="Cập nhập" />
        </form>
        <div class="form-group">
            <label>Trưởng Phòng/Ban:</label>
            <input type="text" name="employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin"
              disabled />
          </div>

          <div class="form-group">
            <label>Lãnh đạo:</label>
            <input type="text" name="employeeNumber" class="form-control" placeholder="Bạn cần nhập thông tin"
              required="" disabled/>
          </div>
      </div>
