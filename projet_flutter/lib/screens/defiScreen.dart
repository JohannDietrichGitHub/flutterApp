import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class DefiScreen extends StatefulWidget {
  const DefiScreen({Key? key}) : super(key: key);

  @override
  _DefiScreenState createState() => _DefiScreenState();
}

class _DefiScreenState extends State<DefiScreen> {
  Future<List<dynamic>> fetchDefis() async {
    final response = await http.get(Uri(
  scheme: 'http',
  host: 'localhost',
  port: 3000,
  path: '/defi',
  queryParameters: {'action': 'getAll'},
));
    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else {
      throw Exception('Failed to load defis');

    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Défis'),
      ),
      body: FutureBuilder<List<dynamic>>(
        future: fetchDefis(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.waiting) {
            return Center(child: CircularProgressIndicator());
          } else if (snapshot.hasError) {
            return Center(child: Text('Erreur: ${snapshot.error}'));
          } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
            return Center(child: Text('Aucun défi trouvé.'));
          } else {
            return ListView.builder(
              itemCount: snapshot.data!.length,
              itemBuilder: (context, index) {
                var defi = snapshot.data![index];
                return Card(
                  margin: EdgeInsets.all(10),
                  child: ListTile(
                    title: Text(defi['defi']),
                    subtitle: Text('Points: ${defi['points']}'),
                    leading: CircleAvatar(
                      child: Text(defi['id_cartes_defi'].toString()),
                    ),
                  ),
                );
              },
            );
          }
        },
      ),
    );
  }
}
