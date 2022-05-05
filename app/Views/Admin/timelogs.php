  <div class="container">
    <table class="table table-striped table-hover">
      <thead>
          <th>UID</th>
          <th>Email</th>
          <th>Timestamp</th>
          <th>Login Time</th>
      </thead>
      <tbody>
            <?php for($i=0;$i<count($UID);$i++) { ?>
            <tr>
              <td><?=$UID[$i]?></td>
              <td><?=$EMAIL[$i]?></td>
              <td><?=$TIME[$i]?></td>
              <td><?=$STRINGTIME[$i]?></td>
            </tr>
            <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
