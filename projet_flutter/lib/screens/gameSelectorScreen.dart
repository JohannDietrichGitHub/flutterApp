import 'package:flutter/material.dart';

class gameSelectorScreen extends StatelessWidget {
  final int testValue;
  const gameSelectorScreen({Key? key, required this.testValue}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Second Screen'),
      ),
      body: Center(
        child: Column (children: [
        const Text(
          'Welcome to the Second Screen!',
          style: TextStyle(fontSize: 24),
        ),
        Text(
          'passed value : $testValue',
          style: TextStyle(fontSize: 24),
        ),
        ],)
      ),
    );
  }
}
