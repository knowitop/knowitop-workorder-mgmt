# knowitop-workorder-mgmt/1.1.1

## Управление работами

Автоматическое создание нарядов по расписанию.

График работ по указанному расписанию автоматически создает наряд на работу из шаблона и привязывает к наряду конфигурационные единицы из графика. Расширение предоставляет графики двух типов: фиксированный и интервальный.

- Фиксированный график используется для задания фиксированного расписания работ, например каждую пятницу в 10:00. Наряд будет создаваться автоматически в указанное время.
- Интервальный график используется для задания максимального интервала между работами, например не реже 1 раза в неделю. В этом случае очередной наряд будет создаваться только после выполнения предыдущего.

Дополнительные возможности:

- Шаблоны нарядов на работу
- Расширенный жизненный цикл нарядов: Новый > Назначен > Открыт > Закрыт
- Новые атрибуты наряда:
    - номер в формате W-012345
    - организация тикета
    - плановые и фактические даты начала и окончания
    - описание решения
- Привязка конфигурационных единиц к нарядам

Требования:

- iTop 3.0.0 или выше
- [knowitop-dashlet-calendar](https://github.com/knowitop/knowitop-dashlet-calendar)
- [knowitop-checklist](https://github.com/knowitop/knowitop-checklist) (опционально)

<img width="2798" height="1910" alt="image" src="https://github.com/user-attachments/assets/a05acb19-b898-4de3-829e-aaf477cf4fe0" />
<img width="2798" height="1910" alt="image" src="https://github.com/user-attachments/assets/c6ae77c2-f602-4f2b-a945-19a7c93d4743" />
<img width="2798" height="1910" alt="image" src="https://github.com/user-attachments/assets/8f56175f-db18-4b2d-8de6-f0cd1527dec2" />
<img width="2798" height="1910" alt="image" src="https://github.com/user-attachments/assets/730f7980-d418-4187-bd4e-f0eb8ceb198e" />
<img width="2798" height="1910" alt="image" src="https://github.com/user-attachments/assets/3b922821-fe53-4c96-aaad-416f0156d84e" />


## Work Order Management

Automated scheduled work order creation.

The work schedule automatically generates work orders from a template based on the specified schedule and links configuration items from the schedule to the work order. The extension provides two types of schedules: fixed and interval-based.

- Fixed schedule is used to set a strict timetable for work orders, e.g., every Friday at 10:00 AM. The work order will be created automatically at the specified time.
- Interval-based schedule is used to define the maximum allowed interval between work orders, e.g., at least once a week. In this case, a new work order will only be created after the previous one has been completed.

Additional Features:

- Work order templates
- Enhanced work order lifecycle: New > Assigned > Open > Closed
- New work order attributes:
    - Reference number (format: W-012345)
    - Ticket organization
    - Planned & actual start/end dates
    - Resolution description
- Linking configuration items to work orders

Requirements:

- iTop 3.0.0 or higher
- [knowitop-dashlet-calendar](https://github.com/knowitop/knowitop-dashlet-calendar)
- [knowitop-checklist](https://github.com/knowitop/knowitop-checklist) (optional)

