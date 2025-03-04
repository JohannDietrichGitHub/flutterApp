import 'package:flutter/material.dart';
import 'package:projet_flutter/screens/gameSelectorScreen.dart';
import 'package:projet_flutter/screens/PageNotFound.dart';
import 'package:projet_flutter/screens/defiScreen.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Flutter Demo',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.green),
        useMaterial3: true,
      ),
      home: const MyHomePage(title: 'Jeux !'),
    );
  }
}

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key, required this.title});

  // This widget is the home page of your application. It is stateful, meaning
  // that it has a State object (defined below) that contains fields that affect
  // how it looks.

  // This class is the configuration for the state. It holds the values (in this
  // case the title) provided by the parent (in this case the App widget) and
  // used by the build method of the State. Fields in a Widget subclass are
  // always marked "final".

  final String title;

  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  int _testValue = 0;

  final Map<String, Widget Function(int)> pageRoutes = {
    'gameselectorscreen': (testValue) => gameSelectorScreen(testValue: testValue),
    'defiScreen': (testValue) => DefiScreen(),

  };

  void _navigateToPage(String pageTitle) {
    if (pageRoutes.containsKey(pageTitle)) {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => pageRoutes[pageTitle]!(_testValue)),
      );
    } else {
      Navigator.push(
        context,
        MaterialPageRoute(builder: (context) => const PageNotFound()),
      );
    }
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Theme.of(context).colorScheme.inversePrimary,
        title: Text(widget.title),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                  onPressed: () => _navigateToPage('gameselectorscreen'),
                  child: const Text('Button 1'),
                ),
                const SizedBox(width: 20),
                ElevatedButton(
                  onPressed: () => _navigateToPage('anotherPage'),
                  child: const Text('Button 2'),
                ),
              ],
            ),
            const SizedBox(height: 20),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(
                  onPressed: () => _navigateToPage('defiScreen'),
                  child: const Text('Button 3'),
                ),
                const SizedBox(width: 20),
                ElevatedButton(
                  onPressed: () => _navigateToPage('yetAnotherPage'),
                  child: const Text('Button 4'),
                ),
              ],
            ),
          ],
        ),
      ),
    );
  }
}