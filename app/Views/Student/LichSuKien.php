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
    <div class="time-select-box">
      <?php
        $today = date("d-m-Y");
        $currentDate = $today;
        if(isset($_GET['StartDate']))
        {
            $currentDate = trim($_GET['StartDate']);
        }
        $startOfCurrentWeek = date('d-m-Y', strtotime('monday this week'));
        $endOfCurrentWeek = date('d-m-Y', strtotime('sunday this week')); 

        $startOfWeek = date('d-m-Y', strtotime('monday this week', strtotime($currentDate)));
        $endOfWeek   = date('d-m-Y', strtotime('sunday this week', strtotime($currentDate)));

        $preWeek = strtotime('-1 week', strtotime($currentDate));
        $startOfPreWeek = date('d-m-Y', strtotime('monday this week', $preWeek));
        $endOfPreWeek   = date('d-m-Y', strtotime('sunday this week', $preWeek));
        
        $nextWeek = strtotime('+1 week', strtotime($currentDate));
        $startOfNextWeek = date('d-m-Y', strtotime('monday this week', $nextWeek));
        $endOfNextWeek   = date('d-m-Y', strtotime('sunday this week', $nextWeek));

      ?>
      <a class="btn btn-primary" href="Student/LichSuKien<?php echo "?StartDate=".$startOfPreWeek."&EndDate=$endOfPreWeek"; ?>">Tuần trước</a>
      <input type="text" class="form-control" readonly value="<?php echo $startOfWeek . " đến " . $endOfWeek ?>" >
      <a class="btn btn-primary" href="Student/LichSuKien<?php echo "?StartDate=".$startOfNextWeek."&EndDate=$endOfNextWeek"; ?>">Tuần sau</a>
      <a class="btn btn-outline-primary" href="Student/LichSuKien<?php echo "?StartDate=".$startOfCurrentWeek."&EndDate=$endOfCurrentWeek"; ?>">Xem tuần hiện tại</a>
      <a class="btn btn-outline-primary" href="Student/LichSuKien<?php echo "?StartDate=".$today."&EndDate=$today"; ?>">Xem ngày hiện tại</a>
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
                          <span class="event-date-circle">'.date('d', strtotime($listEventDate['date'])).' </span>
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
                      echo '<td>'.(!empty($event['ThoiGianBatDauSK']) ? date('H:i', strtotime($event['ThoiGianBatDauSK'])) : '--:--').'</td>';
                      echo '<td>'.$event['TenSK'].'</td>';
                      echo '<td>'.$event['NoiToChuc'].'</td>';
                      echo '<td>'.$event['Ghi chú'].'</td>';
                      $first = false;
                  }
                  else
                  {

                      echo '<td>' . (!empty($event['ThoiGianBatDauSK']) ? date('H:i', strtotime($event['ThoiGianBatDauSK'])) : '--:--') . '</td>';
                              echo '<td>' . $event['TenSK'] . '</td>';
                              echo '<td>' . $event['NoiToChuc'] . '</td>';
                              echo '<td>' . $event['Ghi chú'] . '</td>';
                  }
                  echo '</tr>';

              }
          }
          
          ?>


        </tbody>
      </table>
    </div>

  </div>

</div>
