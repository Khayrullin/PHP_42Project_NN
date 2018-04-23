# Распознавание цифровых изображений
![alt text](http://myselph.de/mnistExamples.png)
1. Общие сведения
2. Назначение и цели создания (развития) системы
3. Характеристика объектов автоматизации
4. Требования к системе
5. Состав и содержание работ по созданию системы
6. Порядок контроля и приемки системы
7. Требования к составу и содержанию работ по подготовке объекта автоматизации к вводу системы в действие
8. Требования к документированию
9. Источники разработки

# 1.	Общие сведения

Полное наименование: Нейронная сеть, распознающая рукописные изображения цифр. 
Краткое наименование: Нейросеть.
Работа выполняется на основании дисциплины “Проектный практикум”, в “лаборатории 42” Высшей школы ИТИС.
Плановые сроки начала и окончания работы:
Плановые сроки начала: 1.12.2017
Плановые сроки окончания работ: 30.05.2018
Ближе к стадии окончания работ сроки уточняются. 
Работы по созданию Нейросети сдаются Разработчиком поэтапно в соответствии с календарным планом Проекта. По окончании каждого из этапов работ Разработчик сдает Заказчику соответствующие отчетные документы этапа, состав которых определены Договором.

# 2.	Назначение и цели создания (развития) системы



Разработка необходима для усвоения и закрепления материала по курсам “Машинное обучение” и 
“Основы программирования на языке PHP”,  упор на применение нейронных сетей. Проект является 
основой для написания в последующем  курсовой работы в рамках дисциплины «Проектный практикум». 
Целью данной разработки является освоение моделирования нейронных сетей. В ходе работа необходимо
решить задачу по распознавания рукописных изображений цифр с помощью нейронной сети.

# 3. Характеристика объектов автоматизации


Объектом автоматизации являются процессы по распознаванию датасета рукописных изображений MNIST, 
а также контроль эффективности выполнения указанных процессов.




# 4. Требования к системе

4.1 Требования к функциональным характеристикам

Система должна обеспечивать возможность выполнения следующих функций:

·	Импорт данных
·	Обработка данных	
·	Нормализация данных
·	Настройка параметров нейронной сети
·	Обучение нейронной сети
·	Визуализация данных
·	Эксперимент
·	Сохранение обученной нейронной сети
·	Экспорт данных


4.2 Требования к надежности

·	Предусмотреть контроль вводимой информации
·	Предусмотреть блокировку некорректных действий пользователя при работе с системой
·	Обеспечить целостность хранимой информации

# 5. Состав и содержание работ по созданию системы

В состав работ по созданию нейронной сети, которая раскрашивает чёрно-белые изображения входят:

·	Создание «альфа»-версии нейросети которая решает задачи, основываясь на входных данных 
·	Построение нейронной сети максимально точно подготовленной и решающей задачу распознавания изображений из MNIST

В содержание работ по созданию нейронной сети, которая раскрашивает чёрно-белые изображения входят:

·	Представление изображений в виде сетки из пикселей
·	Создание классификатора
·	Построение каркаса нейронной сети
·	Сопоставление вычисленных значений с реальными с использованием функции активации
·	Сравнение погрешности вычисления при помощи «нормализации»
·	Прогон тестового изображения через обученную нейронную сеть

# 6. Порядок контроля и приемки системы


Приемка системы осуществляется на этапе ее апробации в образовательном процессе учреждения образования.
На этапе апробации необходима проверка функционирования всех компонентов системы и реализованных сервисов.

# 7. Требования к составу и содержанию работ по подготовке объекта автоматизации к вводу системы в действие

Для подготовки объекта автоматизации к вводу системы в действие должны быть получены следующие исходные данные:

·	Статистические данные 
·	Параметры нормализации
·	Количество слоев и нейронов
·	Параметры обучения нейронной сети
·	Условия завершения обучения нейронной сети
·	Параметры визуализации данных
·	Данные для эксперимента	

Система учета должна быть проста в использовании и не требовать сложной специальной подготовки пользователей. Функционирование должно осуществляться без специалистов по информационно-программному обеспечению.
Основные мероприятия по вводу системы в действие включают: создание условий функционирования объекта автоматизации, при которых гарантируется соответствие создаваемой системы требованиям, содержащимся в ТЗ.

# 8. Требования к документированию

Проектная и рабочая документация должна быть понятна разработчикам, аналитикам и тестировщикам. Должен быть следующий комплект документов:
·	Инструкции пользователей
·	Проектная документация
·	Рабочая документация
·	Техническая документация
·	Маркетинговая документация

8.1 Требования к проектной документации

Документация должна включать в себя описание основных положений, используемых при создании ПО и рабочей среды.
Должна описывать проект в общих чертах.

8.2	Требования к рабочей документации

Рабочая документация должна включать в себя алгоритмы, код, источники данных. Должна содержать исходные коды программы. 
Код должен быть снабжен комментариями. В коде не допустимы закомментированные функциональные блоки. Наименование переменных должны быть унифицированы во всех функциях.

8.3	Требования к технической документации

Она же пользовательская, включает руководства для пользователей программы. Должна включать в себя:
·	Вводное руководство, где рассматриваются общие вопросы разрабатываемой системы
·	Список команд, включающая пояснение и выполнение условий, при которых эта команда может сработать

# 9. Источники разработки

1. Каллан Р. Основные концепции нейронных сетей.
2. Круглов В.В., Борисов В.В. Искусственные нейронные сети. Теория и практика. – М.: Горячая линия – Телеком, 2001. – 382 с.:ил.
3. Барский А. Б. Логические нейронные сети; Интернет-университет информационных технологий, Бином. Лаборатория знаний - Москва, 2007. - 352 c.
4. Саймон Хайкин. Нейронные сети. Полный курс.
5. Г.Э. Яхъяева. Нечеткие множества и нейронные сети.
6. С. Короткий. Нейронные сети: алгоритм обратного распространения.
7. Artificial Neural Net – Ссылки на cworks – объяснение принципов работы нейронных сетей.
8. Осовский С. Нейронные сети для обработки информации.
9. Харт П., Дуда Р. Распознавание образов и анализ сцен.
10. Змитрович А. Интеллектуальные информационные системы.
# 11.https://m.habrahabr.ru/post/352632/






