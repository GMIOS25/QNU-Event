<head>
    <link rel="stylesheet" href="assest/css/student/lichsukien.css">
</head>
<div class="event-schedule-container">

  <div class="event-card">

    <!-- Header -->
    <div class="event-header">
      <i class="bi bi-calendar-event"></i>
      <span>Lịch sự kiện tuần</span>
    </div>

    <!-- Thời gian hiện tại -->
    <div class="event-current-time">
      Thời gian hiện tại : 30/10/2025 7:00
    </div>

    <!-- Bảng sự kiện -->
    <div class="event-table-wrapper">
      <table class="event-table">
  <colgroup>
    <col style="width: 10%;">
    <col style="width: 10%;">
    <col style="width: 40%;">
    <col style="width: 20%;">
    <col style="width: 20%;">
  </colgroup>

  <thead>
    <tr>
      <th>Ngày</th>
      <th>Thời gian</th>
      <th>Tên sự kiện</th>
      <th>Nơi tổ chức</th>
      <th>Ghi chú</th>
    </tr>
  </thead>
  
        <tbody>
          <?php 
            // var_dump($listEventWeek);
            // exit; 
          foreach ($listEventWeek as $listEventDate)
          {
              $events = $listEventDate['eventsList'] ?? [];   
              $rowspan = count($events);
              $thu = date('N', strtotime($listEventDate['date']));
              $mapThu = [
                  1 => 'Thứ 2',
                  2 => 'Thứ 3',
                  3 => 'Thứ 4',
                  4 => 'Thứ 5',
                  5 => 'Thứ 6',
                  6 => 'Thứ 7',
                  7 => 'Chủ nhật'
              ];
              if ($rowspan == 0) {
                  // Ngày không có sự kiện
                  echo '<tr>';
                  echo '<td class="event-date" rowspan="1">
                          <span class="event-date-circle">'.date('d', strtotime($listEventDate['date'])).'<br> </span>
                          <span class="event-day-label">'.$mapThu[$thu].'</span>
                          </td>';
                  echo '<td colspan="4" class="no-event">Không có sự kiện</td>';
                  echo '</tr>';
                  continue;
              }

              $first = true;
              foreach ($events as $event)
              {
                  echo '<tr>';
                  
                  if ($first) {
                      echo '<td class="event-date" rowspan="'.$rowspan.'">
                              <span class="event-date-circle">'.date('d', strtotime($listEventDate['date'])).'</span>
                              <span class="event-day-label">'.$mapThu[$thu].'</span>
                            </td>';
                      $first = false;
                  }

                  echo '<td>'.(!empty($event['ThoiGianBatDauSK']) ? date('H:i', strtotime($event['ThoiGianBatDauSK'])) : '--:--').'</td>';
                  echo '<td>'.$event['TenSK'].'</td>';
                  echo '<td>'.$event['NoiToChuc'].'</td>';
                  echo '<td>'.$event['Ghi chú'].'</td>';
                  echo '</tr>';
              }
          }

          
          ?>
          <!-- Ngày 30
          <tr>
            <td  rowspan="3">
              <span class="event-date-circle">30</span>
            </td>
            <td>7:00 - 11:00</td>
            <td>Lễ khai giảng năm học 2025 - 2026</td>
            <td>Hội trường B</td>
            <td>Đang diễn ra</td>
          </tr>

          <tr>
            <td class="col-2">7:00 - 11:00</td>
            <td class="col-3">Lễ khai giảng năm học 2025 - 2026</td>
            <td class="col-4">Hội trường B</td>
            <td  class="col-5 event-status">Đang diễn ra</td>
          </tr>

          <tr>
            <td class="col-2">7:00 - 11:00</td>
            <td class="col-3">Lễ khai giảng năm học 2025 - 2026</td>
            <td class="col-4">Hội trường B</td>
            <td  class="col-5 event-status">Đang diễn ra</td>
          </tr>


        </tbody>
      </table>
    </div>

  </div>

</div>
